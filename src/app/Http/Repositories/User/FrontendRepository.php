<?php
namespace App\Http\Repositories\User;

use App\Http\Repositories\Eternal\GeneralRepository;
use App\Http\Utility\SendNotificationUtility;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Package;
use App\Models\Reply;

class FrontendRepository{

    /**
     * hide cookie method
     */
     public function hideCookie($request){
        if($request->has('status')){
            session()->put('hide-cookie','hide');
            $response = true ;
        }
        else{
            $response = false ;
        }
        return $response;
     }
    /**
     * hide ads method
     */
     public function hideAds($request){
        if($request->has('status')){
            session()->put('hide-ad','hide');
            $response = true ;
        }
        else{
            $response = false ;
        }
        return $response;
     }

     /**
      * get a specific page details
      */
      public static function pages($slug){
        $page = Page::where('slug->'.getSystemLocale(),$slug)->first();
        if($page){
            self::counting($page,'page_view_count','page_id');
            return $page;
        }
        else{
            return false;
        }
      }

      /**
       * get specific blog
       */
      public static function getBlog($key,$type ='id'){
        if($type == 'id'){
            return GeneralRepository::findElement('Blog',$key);
        }
        else{
            return Blog::with(['comments','comments.reply','category','updatedBy','createdBy','comments.user'])->where('slug->'.getSystemLocale(),$key)->firstOrFail();
        }
      }

      /**
       * blog like count
       */
      public static function blogLike($id){
        $blog = self::getBlog($id);
        $previousTotalLike =  $blog->like_count;
        self::counting($blog,'like_count','blog_id');
        $presentTotalLike =  $blog->like_count;
        if($previousTotalLike == $presentTotalLike){
            $response ['success'] = 'error';
            $response ['message'] = decode('Already Liked');
        }
        else{
            $response['like'] =  $presentTotalLike;
            $response ['success'] = 'success';
            $response ['message'] = decode('You Liked it !!!');
        }
        return $response;
      }


      /**
       * blog comment like count
       */
      public static function commentLike($id){
        $comment = GeneralRepository::getSpecifcComment($id);
        $previousTotalLike =  $comment->like_count;
        self::counting($comment,'like_count','comment_id');
        $presentTotalLike =  $comment->like_count;
        if($previousTotalLike == $presentTotalLike){
            $response ['success'] = 'error';
            $response ['message'] = decode('Already Liked');
        }
        else{
            $response['like'] =  $presentTotalLike;
            $response ['success'] = 'success';
            $response ['message'] = decode('You Liked it !!!');
        }
        return $response;
      }

      /**
       * blog comment reply like count
       */
      public static function replyLike($id){
        $reply = GeneralRepository::getSpecifcCommentReply($id);
        $previousTotalLike =  $reply->like_count;
        self::counting($reply,'like_count','reply_id');
        $presentTotalLike =  $reply->like_count;
        if($previousTotalLike == $presentTotalLike){
            $response ['success'] = 'error';
            $response ['message'] = decode('Already Liked');
        }
        else{
            $response['like'] =  $presentTotalLike;
            $response ['success'] = 'success';
            $response ['message'] = decode('You Liked it!!');
        }
        return $response;
      }

      /**
       * blog comments
       *
       * @param $request
       */
       public static function blogComments($request){
            $comment = new Comment();
            $comment->blog_id = $request->blog_id;
            $comment->user_id = authUser('web')->id;
            $comment->comment = $request->comment;
            $comment->save();
            $details['route'] = route('admin.blog.comment.index');
            $details['user'] = authUser('web')->name ? authUser('web')->name: authUser('web')->email;
            $details['message'] = decode('Just Commented On Your Post');
            SendNotificationUtility::sendNotification($details);
            return $comment;
       }


      /**
       * blog comments reply
       *
       * @param $request
       */
       public static function blogCommentReply($request){
            $reply = new Reply();
            $reply->comment_id = $request->comment_id;
            $reply->user_id = authUser('web')->id;
            $reply->reply = $request->reply;
            $reply->save();
            $details['route'] = route('admin.blog.comment.reply.index',$reply->comment_id);
            $details['user'] = authUser('web')->name ? authUser('web')->name: authUser('web')->email;
            $details['message'] = decode('Just Replied To A Comment');
            SendNotificationUtility::sendNotification($details);
            return $reply;
       }

      /**
       * store contact info
       *
       * @param $request
       */
       public static function contactStore($request){
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->message = $request->message;
            $contact->subject = $request->subject;
            $contact->save();
       }




      /**
       * blog by catyegory
       *
       * @param $request
       */
       public static function getBlogByCategory($slug){
         $category = Category::where('slug->'.getSystemLocale(),$slug)->first();
         return Blog::with(['comments.reply','comments.user','comments','createdBy','updatedBy'])->where('id',$category->id)->paginate(paginationNumber());
       }

      /**
       * count like page view ip or session base
       */
      public static function counting($page,$column ,$sessionParam,$ipColumn = 'ip_address'){
        if(generalSetting()->count_by == 'ip'){
            $clientIP = request()->getClientIp(true);
            $storedIp  = json_decode($page->$ipColumn,true);
            if(!$storedIp){
              $storedIp = [];
              array_push($storedIp, $clientIP);
              $page->increment($column);
            }
            else{
                if(!in_array( $clientIP,$storedIp)){
                    array_push($storedIp, $clientIP);
                    $page->increment($column);
                }
            }
            $page->$ipColumn = json_encode($storedIp);
            $page->save();
        }
        else{
            $pageId = [];
            if(!session()->has($sessionParam)){
                array_push($pageId,$page->id);
                session()->put($sessionParam,$pageId);
                $page->increment($column);
            }
            else{
                $pageId  = session()->get($sessionParam);
                if(!in_array($page->id,$pageId)){
                    array_push($pageId, $page->id);
                    session()->push($sessionParam,$page->id);
                    $page->increment($column);
                }
            }
        }
      }

      /**
       * get a specific package
       */
      public static function getPackage($id){
        return Package::where('id',$id)->first();
      }
}
