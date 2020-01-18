<?php

use Illuminate\Support\Facades\DB;

$site_info = DB::table('site_info')->get();
$info_element_array = array();
foreach ($site_info as $info_element) {
    $info_element_array[$info_element->attr_name] = $info_element->attr_value;
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('uploads/avatars/'.$info_element_array['logo_pic']) }}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{$info_element_array['test_next_to_logo']}}</title>


@yield('open-graph')
<!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">

    <!-- Dropzone Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link href="{{ asset('css/tableexport.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap-star-rating/css/star-rating.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendors/bootstrap-star-rating/themes/krajee-fa/theme.min.css')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('vendors/DataTables/datatables.css')}}">
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Loding gif call for event model add -->
      <div align="center" id="main_result" style=" position: absolute;
        z-index: 999;
        margin: 0 auto;
        left: 0;
        right: 0; 
        top: 40%;       
        text-align: center; 
        display: none"><img src="{{ asset('images/loading.gif')}}" style="height: 100px;" /></div>
    <style>
        .modal-backdrop{
            display: none!important;
        }
        .hide {
            display: none;
        }

        .m-t-12 {
            margin-top: 12px;
        }

        .p-abs {
            position: absolute;
        }

        .t-36 {
            top: 36%;
        }

        .show-ic:hover .image-upload-icon {
            opacity: 1 !important;
        }

        .query .table .left-one {
            width: 119px;
        }

        .query tr.frst-one {
            background-color: #948a54;
            color: #000;
        }

        .query tbody tr td {
            padding: 16px 0px;
        }

        .query tbody tr td.first-row {
            padding: 12px 0px;
        }

        .query tr td img {
            width: 18px;
            float: right;
            margin-right: 21px;
        }

        .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
            border: 1px solid #000;
        }

        .queryscreen .main-for-back {
            background-color: #e1dfe3;
            padding: 8px 28px;
            border-top: 1px solid #939394;
            border-bottom: 1px solid #939394;
        }

        .queryscreen .main-for-back .main-content-left {
            float: right;
        }

        .queryscreen .main-for-back .main-content-left a.btn {
            padding: 0px;
            margin-right: 20px;
        }

        .queryscreen .main-for-back .main-content-left a.btn i {
            font-size: 19px;
        }

        .queryscreen .main-content h3 {
            margin: 0px;
        }

        .textarea-sec textarea {
            width: 100%;
            overflow-y: scroll;
            overflow-x: scroll;
            border-top: 3px solid #dcd9d9;
            border-left: 3px solid #dcd9d9;
        }

        .textarea-sec {
            border: 1px solid #000;
            padding: 6px 6px;
        }

        .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
            border: 1px solid #dedada;
        }

        tr.f-row {
            background-color: #e1dfe3;
        }

        tr.f-row th {
            color: #000;
        }

        .table-dummy {
            height: 500px;
            overflow-x: scroll;
            overflow-y: scroll;
        }

        .table-dummy table {
            border-top: 3px solid #aba8a8;
            border-left: 3px solid #aba8a8;
        }

        i.fa-play {
            color: #0b8107;
        }

        i.fa-download {
            color: #000;
        }

        i.fa-floppy-o {
            color: #8255b1;
        }

        .m-l-79 {
            margin-left: 79px;
        }

        .w-40 {
            width: 40%;
        }

        .m-r-35 {
            margin-right: 35px !important;
        }

        .m-r-19 {
            margin-right: 19px !important;
        }

        .m-l-12 {
            margin-left: 12px;
        }

        img:hover {
            cursor: pointer;
        }

        .description {
            cursor: pointer;
        }

        .fl-r {
            float: right;
        }

        .crs-pntr {
            cursor: pointer;
        }

        .m-t-25 {
            margin-top: 25px;
        }

        .p-l-12 {
            padding-left: 12px;
        }

         }

        /* Slider */

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
        }

        .slick-slider {
            position: relative;
            display: block;
            box-sizing: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -khtml-user-select: none;
            -ms-touch-action: pan-y;
            touch-action: pan-y;
            -webkit-tap-highlight-color: transparent;
        }

        .slick-list {
            position: relative;
            display: block;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .slick-list:focus {
            outline: none;
        }

        .slick-list.dragging {
            cursor: pointer;
            cursor: hand;
        }

        .slick-slider .slick-track,
        .slick-slider .slick-list {
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .slick-track {
            position: relative;
            top: 0;
            left: 0;
            display: block;
        }

        .slick-track:before,
        .slick-track:after {
            display: table;
            content: '';
        }

        .slick-track:after {
            clear: both;
        }

        .slick-loading .slick-track {
            visibility: hidden;
        }

        .slick-slide {
            display: none;
            float: left;
            height: 100%;
            min-height: 1px;
        }

        [dir='rtl'] .slick-slide {
            float: right;
        }

        .slick-slide img {
            display: block;
        }

        .slick-slide.slick-loading img {
            display: none;
        }

        .slick-slide.dragging img {
            pointer-events: none;
        }

        .slick-initialized .slick-slide {
            display: block;
        }

        .slick-loading .slick-slide {
            visibility: hidden;
        }

        .slick-vertical .slick-slide {
            display: block;
            height: auto;
            border: 1px solid transparent;
        }

        .slick-arrow.slick-hidden {
            display: none;
        }

        .p-b-1 {
            padding-bottom: 1px !important;
        }

        .p-l-r {
            padding-left: 6px;
            padding-right: 7px;
        }

        .m-b-1-e {
            margin-bottom: 1rem !important;
        }

        .p-r-8 {
            padding-right: 8px !important;
        }

        .p-r-0 {
            padding-right: 0px !important;
        }

        .p-t-27 {
            padding-top: 12px !important;
        }

        .w-56-p {
            width: 56px !important;
        }

        .b-r-2 {
            border-right: 2px solid lightgrey;
        }

        .f-l-r {
            float: right;
        }

        .p-43-p {
            padding: 43px;
        }

        .txt-algn-center {
            text-align: center;
        }

        * {
            margin: 0px;
            padding: 0px;
        }

        .main-full-form {
            border: 1px solid #d4d4d4;
            margin-bottom: 28px;
        }

        .box-shadow-div {
            box-shadow: 0px 0px 12px 1px #00000042;
            margin-top: 37px;
            padding: 18px 36px 29px 36px;
            margin-bottom: 22px;
        }

        section.membership-pro .close-btn-pro a.left-close {
            text-decoration: none;
            float: right;
            background-color: #aca8a8;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 17px;
            color: #fff;
        }

        section.membership-pro .top-head {
            background-color: #e7e7e7;
            padding: 8px 13px 8px 24px;
        }

        section.membership-pro .top-head h3 {
            padding-top: 42px;
            text-decoration: underline;
            font-size: 30px;
        }

        section.membership-pro .img-left-cont img {
            width: 58%;
            height: 224px;
            border-radius: 12px;
        }

        .content-input-right {
            margin-top: 13px;
        }

        .content-input-right h5 {
            font-size: 20px;
        }

        h5.top-two {
            margin-left: 10px;
        }

        .content-input-right input,
        .content-input-right select {
            padding: 7px 9px;
            font-size: 15px;
            width: 100%;
        }

        h5.grey {
            color: #919191;
        }

        h5 span {
            color: #f00;
            margin-right: 1px;
        }

        .name-input h4 {
            border: 1px solid #9d9d9d;
            width: 57%;
            padding: 10px 96px;
            font-size: 25px;
            border-radius: 4px;
        }

        .name-input span {
            font-size: 23px;
            position: absolute;
            top: 50px;
            top: 7px;
            color: #f00;
            left: 2px;
        }

        .status-drop select {
            padding: 7px 9px;
            font-size: 15px;
            width: 100%;
        }

        table td {
            padding: 16px 8px !important;
            border: 2px solid #808080 !important;
        }

        .second-part {
            padding: 17px 22px 23px 22px;
        }

        .content-second {
            margin-top: 14px;
        }

        .second-part h5 {
            font-size: 20px;
        }

        .second-part input,
        .second-part select {
            padding: 7px 9px;
            font-size: 15px;
            width: 100%;
        }

        input.half {
            width: 86%;
        }

        .right-border {
            border: 1px solid #c2bcbc;
            border-right: 2px solid #000;
        }

        .line {
            background-color: #e7e7e7;
            width: 96%;
            height: 1px;
        }

        .third-content {
            padding: 26px 22px 23px 22px;
        }

        .third-content img {
            width: 47%;
            height: 179px;
            border-radius: 12px;
        }

        .third-content h5 {
            font-size: 20px;
        }

        .input-border {
            border: 1px solid #b6b5b5;
            padding: 4px 9px 4px 2px;
        }

        .input-border input {
            outline: none;
            border: none;
            width: 86%;
        }

        .input-border i {
            font-size: 25px;
        }

        .main-right-social > h4 {
            font-size: 22px;
            text-decoration: underline;
            margin-bottom: 23px;
        }

        .third-content .content-second input {
            padding: 7px 9px;
            font-size: 15px;
            width: 100%;
        }

        .content-second h6 {
            font-size: 18px;
        }

        h6 span {
            font-size: 14px;
        }

        button {
            font-size: 16px !important;
        }

        .main-button a {
            padding: 0px;
            font-size: 29px;
            color: #000;
            margin-left: 7px;
        }

        .cu-po {
            cursor: pointer;
        }

        .w-50 {
            width: 50px !important;
        }

        .h-36 {
            height: 36px !important;
        }

        * {
            margin: 0px;
            padding: 0px;
        }

        section.membership-sec .top-head-sec {
            box-shadow: 0px 0px 12px 0px #00000047;
            margin-top: 37px;

        }

        section.membership-sec .top-head-sec .member-top-bar {
            background-color: #f7f7f7;
            border-bottom: 1px solid #cecece;
        }

        h3.main-head-top {
            margin-left: 24px;
            margin-bottom: 21px;
            font-weight: bold;
            /* letter-spacing: 1px; */
            font-size: 21px;
        }

        section.membership-sec .top-head-sec .member-top-bar a {
            background-color: #848484;
            padding: 4px 10px;
            border-radius: 50%;
            font-size: 20px;
            color: #fff;
            text-decoration: none;
            margin-top: 14px;
            display: inline-block;
            float: right;
            margin-right: 22px;
        }

        .inner-button {
            background-color: #c00000;
            color: #fff;
            /* text-align: center; */
            width: 84%;
            padding: 10px 20px 10px 54px;
            border: 5px solid #fff;
            box-shadow: 0px 0px 12px 0px #0000005e;
        }

        .inner-button.main-sec {
            background-color: #f47930;
        }

        .inner-button h4 {
            font-size: 21px;
        }

        .inner-button h5 {
            font-size: 18px;
        }

        .reg-sec {

        }

        .main-button-regis img {
            position: relative;
            right: -95px;
            width: 181px;
            top: -27px;
            z-index: 1000;
        }

        .main-button-regis {
            margin-top: 89px;
            margin-bottom: 35px;
        }

        .update-and-verify {
            margin-top: 53px;
        }

        h5.member-admin {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #bcbcbc;
        }

        .member-admin-line:before {
            content: "";
            position: absolute;
            height: 3px;
            width: 37%;
            background-color: #bcbcbc;
            top: 21px;
        }

        .member-admin-line:after {
            content: "";
            position: absolute;
            height: 3px;
            width: 37%;
            background-color: #bcbcbc;
            top: 21px;
            right: 15px;

        }

        img.member-image {
            width: 189px;
            height: 189px;
            border-radius: 50%;
        }

        .main-update {
            border-top-left-radius: 22px;
            border: 2px solid #19b1a3;
            border-top-right-radius: 22px;
            text-align: center;
            width: 66%;
            margin: 0 auto;
        }

        .main-update h5 {
            background-color: #19b1a3;
            margin-bottom: 0px;
            padding: 11px 0px;
            font-size: 18px;
            color: #fff;
        }

        .main-update h2 {
            font-size: 39px;
            margin-top: 40px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #19b1a3;
        }

        .input-div {
            border: 1px solid #c4c4c4;
            width: 66%;
            margin: 0 auto;
        }

        .input-div > i {
            background-color: #e7e7e7;
            padding: 13px 16px;
            font-size: 22px;
        }

        .input-div i.srch {
            background-color: #7e7d7d;
            padding: 13px 16px;
            font-size: 22px;
            color: #fff;
        }

        .input-div input {
            padding: 0px 6px 11px 6px;
            border: 0px;
            outline: none;
            box-shadow: none;
            width: 70%;
        }

        .input-div h3 {
            background-color: #19b1a3;
            margin-top: 0px;
            padding: 8px 0px;
            font-size: 24px;
            text-transform: uppercase;
            color: #fff;
            text-align: center;
            margin-bottom: 0px;
        }

        .verify-content {
            margin-top: 55px;
        }

        .main-button-regis.image {
            margin: 0 auto;
            width: 71%;
            margin-top: 90px;
        }

        div.table-div {
            height: 229px;
            overflow-x: scroll;
            width: 83%;
            margin: 0 auto;
        }

        h3.add-prof {
            font-weight: bold;
            margin-left: 95px;
            margin-top: 58px;
            margin-bottom: 22px;
        }

        div.table-div table,
        div.table-div table td,
        div.table-div table th {
            border: 2px solid #bcbbbb;
        }

        tr.head {
            background-color: #948a54;
            color: #fff;
            font-size: 15px;
        }

        div.table-div table td {
            padding: 15px 20px;
        }

        .bottom-btns {
            float: right;
            margin-right: 96px;
            margin-bottom: 28px;
        }

        .bottom-btns a.btn {
            font-size: 17px;
        }

        .bottom-btns a.btn.right {
            margin-right: 10px;
        }

        div.sec-table table td {
            padding: 15px 20px;
        }

        div.sec-table table,
        div.sec-table td {
            border: 2px solid #bcbbbb;
        }

        div.sec-table {
            width: 83%;
            margin: 0 auto;
            margin-top: 24px;
            margin-bottom: 34px;
        }

        .inp-up {
            height: 104px;
            font-size: 26px;
            border: 0px;
            text-align: center;
            color: #19b1a3;
        }

        .inp-up:focus {
            outline: none;
        }

        .tablemessagepopup {
            display: table;
            border-collapse: separate;
            empty-cells: show !important;
            border-color: rgb(253, 250, 250) !important;
            width: 100%;
            /* margin-bottom: 1rem; */
            background-color: transparent;
            border-collapse: collapse !important;
        }

        .messagepopCom {

            margin-bottom: 0px;
            padding-top: 10px;
            padding-bottom: 10px;
            background: transparent;

        }

        .messagepopCom:hover {
            box-shadow: 2px 2px 2px 2px rgb(128, 110, 230);
            background: #0cf31bb2;
        }

        .messagepopCom table td {
            padding: 0 !important;
            border: none !important;
        }

        * {
            margin: 0px;
            padding: 0px;
        }

        section.membership-sec .top-head-sec {
            box-shadow: 0px 0px 12px 0px #00000047;
            margin-top: 37px;

        }

        section.membership-sec .top-head-sec .member-top-bar {
            background-color: #f7f7f7;
            border-bottom: 1px solid #cecece;
        }

        h3.main-head-top {
            margin-left: 24px;
            margin-bottom: 21px;
            font-weight: bold;
            /* letter-spacing: 1px; */
            font-size: 21px;
        }

        section.membership-sec .top-head-sec .member-top-bar a {
            background-color: #848484;
            padding: 4px 10px;
            border-radius: 50%;
            font-size: 20px;
            color: #fff;
            text-decoration: none;
            margin-top: 14px;
            display: inline-block;
            float: right;
            margin-right: 22px;
        }

        .inner-button {
            background-color: #c00000;
            color: #fff;
            /* text-align: center; */
            width: 84%;
            padding: 10px 20px 10px 54px;
            border: 5px solid #fff;
            box-shadow: 0px 0px 12px 0px #0000005e;
        }

        .inner-button.main-sec {
            background-color: #f47930;
        }

        .inner-button h4 {
            font-size: 21px;
        }

        .inner-button h5 {
            font-size: 18px;
        }

        .reg-sec {

        }

        .main-button-regis img {
            position: relative;
            right: -95px;
            width: 181px;
            top: -27px;
            z-index: 1000;
        }

        .main-button-regis {
            margin-top: 89px;
            margin-bottom: 35px;
        }

        .update-and-verify {
            margin-top: 53px;
        }

        h5.member-admin {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #bcbcbc;
        }

        .member-admin-line:before {
            content: "";
            position: absolute;
            height: 3px;
            width: 37%;
            background-color: #bcbcbc;
            top: 21px;
        }

        .member-admin-line:after {
            content: "";
            position: absolute;
            height: 3px;
            width: 37%;
            background-color: #bcbcbc;
            top: 21px;
            right: 15px;

        }

        img.member-image {
            width: 189px;
            height: 189px;
            border-radius: 50%;
        }

        .main-update {
            border-top-left-radius: 22px;
            border: 2px solid #19b1a3;
            border-top-right-radius: 22px;
            text-align: center;
            width: 66%;
            margin: 0 auto;
        }

        .main-update h5 {
            background-color: #19b1a3;
            margin-bottom: 0px;
            padding: 11px 0px;
            font-size: 18px;
            color: #fff;
        }

        .main-update h2 {
            font-size: 39px;
            margin-top: 40px;
            margin-bottom: 20px;
            font-weight: bold;
            color: #19b1a3;
        }

        .input-div {
            border: 1px solid #c4c4c4;
            width: 66%;
            margin: 0 auto;
        }

        .input-div > i {
            background-color: #e7e7e7;
            padding: 13px 16px;
            font-size: 22px;
        }

        .input-div i.srch {
            background-color: #7e7d7d;
            padding: 13px 16px;
            font-size: 22px;
            color: #fff;
        }

        .input-div input {
            padding: 0px 6px 11px 6px;
            border: 0px;
            outline: none;
            box-shadow: none;
            width: 70%;
        }

        .input-div h3 {
            background-color: #19b1a3;
            margin-top: 0px;
            padding: 8px 0px;
            font-size: 24px;
            text-transform: uppercase;
            color: #fff;
            text-align: center;
            margin-bottom: 0px;
        }

        .verify-content {
            margin-top: 55px;
        }

        .main-button-regis.image {
            margin: 0 auto;
            width: 71%;
            margin-top: 90px;
        }

        div.table-div {
            height: 229px;
            overflow-x: scroll;
            width: 83%;
            margin: 0 auto;
        }

        h3.add-prof {
            font-weight: bold;
            margin-left: 95px;
            margin-top: 58px;
            margin-bottom: 22px;
        }

        div.table-div table,
        div.table-div table td,
        div.table-div table th {
            border: 2px solid #bcbbbb;
        }

        tr.head {
            background-color: #948a54;
            color: #fff;
            font-size: 15px;
        }

        div.table-div table td {
            padding: 15px 20px;
        }

        .bottom-btns {
            float: right;
            margin-right: 96px;
            margin-bottom: 28px;
        }

        .bottom-btns a.btn {
            font-size: 17px;
        }

        .bottom-btns a.btn.right {
            margin-right: 10px;
        }

        div.sec-table table td {
            padding: 15px 20px;
        }

        div.sec-table table,
        div.sec-table td {
            border: 2px solid #bcbbbb;
        }

        div.sec-table {
            width: 83%;
            margin: 0 auto;
            margin-top: 24px;
            margin-bottom: 34px;
        }

        .m-t-12 {
            margin-top: 12px !important;
        }

        .m-b-12 {
            margin-bottom: 12px !important;
        }

        .radio-div {
            margin: 0 auto;
            padding-left: 95px;
        }

        .m-l-81 {
            margin-left: 81px !important;
        }

        .f-l-r {

            float: right;
        }

        .m-t-40 {
            margin-top: 80px !important;
        }

        .h-82-p {
            height: 82px;
        }

        .m-r-61 {
            margin-right: 61px;
        }

        .m-r-90 {
            margin-right: 90px;
        }

        .f-s-18 {
            font-size: 18px !important;
        }

        .f-c-r {
            color: red;
        }

        .sub-div {
            background-color: black;
            width: 70%;

        }

        .m-div {
            background-color: #9ead49;
            width: 12%;
            margin-left: 118px;
        }

        .m-l-86 {
            margin-left: 102px !important;
            width: 85%;
        }

        .b-r-38 {
            border-radius: 38px;
        }

        .pa-t-40 {
            padding-top: 40px;
        }

        .m-t-81 {
            margin-top: 81px;
            width: 202px;
        }

        .f-r {
            float: right;
        }

        .m-b-12 {
            margin-bottom: 12px;
        }

        div[data-placeholder]:not(:focus):not([data-div-placeholder-content]):before {

            content: attr(data-placeholder);

            float: left;

            margin-left: 2px;

            color: #b3b3b3;

        }

        .pac-container {
            background-color: #FFF;
            z-index: 9000;
            position: fixed;
            display: inline-block;
            float: left;
        }
        .with-border-top{
            padding-top: 7vh;
            border-top: 2px solid;
            border-color: lightgrey;
        }

        .with-border-bottom{
            padding-bottom: 5vh;
            border-bottom: 2px solid;
            border-color: lightgrey;
        }
        .button-close-modal{
            background-color: grey!important;
            border-radius: 18px!important;
            padding: 0!important;
            height: 18px!important;
            width: 18px!important;
            color: white!important;
            margin: 0!important;
            margin-top: 8px!important;
        }
        .border-modal{
            border: 5px solid;
            border-color: #22b14c;
        }
        .card-width{
            max-width: 250px;
        }
        .card-header .title-container{

        }
        .card-header.filter{
            display: flex;
            padding: 0.25rem 0.5rem !important;
        }
        .card-header.filter .img-container{
            width: 30px;
        }
        .rating-container.rating-xs{
            font-size: 13px!important;
        }
        .rating-xs .rating-stars{
            padding-top: 2vh;
        }
        .rating-xs .filled-stars{
            padding-top: 2vh;
        }
        .no-margin{
            margin-left: 0;
            margin-right: 0;
        }

    </style>


    @yield('custom-styles')
</head>
