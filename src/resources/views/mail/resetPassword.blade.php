<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $details['title'] }}</title>
</head>

<body>

        <div class="dashboard_container">
            <section>
            <div class="container p-0">
                <div class="rounded_box">
                <table cellspacing="0" border="0" cellpadding="0" width="80%" style="
                        @import url('https://fonts.googleapis.com/css2?family=Abel&family=Comfortaa&family=PT+Serif:wght@700&display=swap');
                        margin: 0 auto;
                    ">
                    <tr>
                    <td>
                        <table style="
                            background-color: #3498db;
                            max-width: 100;
                            margin: 0 auto;
                            " width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        </table>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <table style="
                            background-color: #ffffff;
                            max-width: 70%;
                            margin: 5rem auto;
                            " width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="
                                height: 10rem;
                                text-align: left;
                                padding: 2rem;
                                box-shadow: 0 10px 15px rgb(0 0 0 / 5%);
                                ">
                            <table style="text-align: left">
                                <tr>
                                <td style="
                                        width: 100%;
                                        height: 200px;
                                        margin: 0 auto;
                                    ">
                                    <img style="
                                        height: 100%;
                                        width: 300px;
                                        margin: 0 auto;
                                        display: flex;
                                        "
                                        src="{{displayImage('assets/images/general/weblogo/'.$generalSetting->logo, App\Cp\ImageProcessor::filePath()['logo']['size'])}}"
                                    alt="" />

                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <h4 style="
                                        color: #3498db;
                                        font-family: 'Comfortaa', cursive;
                                        margin-bottom: 1rem;
                                        ">
                                     {{ $details['message'] }}
                                    </h4>
                                    <p style="font-size: 16px; text-align: justify">
                                       {{ $details['body'] }}
                                    </p>
                                    <br/>
                                        <a href="{{ route('admin.updatePassword',$details['token']) }}"   style="
                                            text-decoration:none;
                                            padding: 5px 12px;
                                            border: 1px solid rgb(255, 255, 255);
                                            background: #ff9d00;
                                            color: white;
                                            ">
                                            {{ $details['buttonText'] }}
                                        </a>
                                    <br />
                                    <br />
                                    <p style="color: #000000">
                                    If you have any questions, just reply to this
                                    email <br />
                                    we're always happy to help out.
                                    </p>
                                    <br />
                                    <a href="tel:{{ $generalSetting->phone }}">Please Contact with Us</a>
                                </td>
                                </tr>
                            </table>
                            <br />
                            <br />
                            <table style="width: 100%; height: 70px">
                                <tr>
                                <td>

                                    <span>Powered by</span><br />
                                    <a target='_blanck' href='{{ json_decode($generalSetting->mail_footer,true)['link'] }}'>
                                    <img style="height: 50px; width: 150px"
                                    src="{{ displayImage('assets/images/general/mailFooter/' . json_decode($generalSetting->mail_footer,true)['logo'], App\Cp\ImageProcessor::filePath()['mail_footer']['size']) }}" alt="" />
                                    </a>
                                </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                </table>
                </div>
            </div>
            </section>
        </div>

</body>
</html>




