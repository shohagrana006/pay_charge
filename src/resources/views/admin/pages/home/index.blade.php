@extends('layouts.admin.admin_app')

@section('admin_main_content')
asdasd


<h5 class="mb-3">Toaster</h5>
<div class="modals_btn">
    <button onclick="toaster001('success','Successfull Login','top-end')" class="btn btn--success--lite text--success me-2">Successfull</button>
    <button onclick="toaster001('error','Error Occured','top-end')" class="btn btn--danger--lite text--danger me-2">Error</button>
    <button onclick="toaster001('warning','Something went wrong','top-end')" class="btn btn--warning--lite text--warning me-2">Warning</button>
    <button onclick="toaster001('info','This is your information','top-end')" type="button" class="btn btn--info--lite text--info me-2">Info</button>
    <button onclick="toaster001('question','Really want to proceed?','top-end')" type="button" class="btn btn--secondary--lite text--secondary me-2">Question</button>
</div>

@endsection


