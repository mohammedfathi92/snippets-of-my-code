<!DOCTYPE html><html class=''>
<head>
  <meta charset='UTF-8'>
  <meta name="robots" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <meta name="csrf-token" content="{{csrf_token()}}">
<!--   <link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/chat/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
 --><!--   <link rel="mask-icon" type="" href="//production-assets.codepen.io/chat/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
 -->  
  <link rel="canonical" href="https://codepen.io/emilcarlsson/pen/ZOQZaV?limit=all&page=74&q=contact+" />
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>

  <!--Bootstrap 4-->
   {!! Theme::css('chat/css/bootstrap.min.css') !!}
  {!! Theme::css('chat/css/font-awesome.min.css') !!}
  {!! Theme::css('chat/css/reset.min.css') !!}
  <style class="cp-pen-styles">
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      /*background: #27ae60;*/
      background: #fff;
      font-family: "proxima-nova", "Source Sans Pro", sans-serif;
      font-size: 1em;
      letter-spacing: 0.1px;
      color: #32465a;
      text-rendering: optimizeLegibility;
      text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
      -webkit-font-smoothing: antialiased;
    }

    #frame {
      width: 100%;
      min-width: 360px;
      /*max-width: 1000px;*/
      /*height: 92vh;*/
      height: 100vh;
      min-height: 300px;
      /*max-height: 720px;*/
      background: #E6EAEA;
    }
    @media screen and (max-width: 360px) {
      #frame {
        width: 100%;
        height: 100vh;
      }
    }
    #frame #sidepanel {
      float: left;
      min-width: 280px;
      max-width: 340px;
      width: 40%;
      height: 100%;
      background: #2c3e50;
      color: #f5f5f5;
      overflow: hidden;
      position: relative;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel {
        width: 58px;
        min-width: 58px;
      }
    }
    #frame #sidepanel #profile {
      width: 80%;
      margin: 25px auto;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile {
        width: 100%;
        margin: 0 auto;
        padding: 5px 0 0 0;
        background: #32465a;
      }
    }
    #frame #sidepanel #profile.expanded .wrap {
      height: 210px;
      line-height: initial;
    }
    #frame #sidepanel #profile.expanded .wrap p {
      margin-top: 20px;
    }
    #frame #sidepanel #profile.expanded .wrap i.expand-button {
      -moz-transform: scaleY(-1);
      -o-transform: scaleY(-1);
      -webkit-transform: scaleY(-1);
      transform: scaleY(-1);
      filter: FlipH;
      -ms-filter: "FlipH";
    }
    #frame #sidepanel #profile .wrap {
      height: 60px;
      line-height: 60px;
      overflow: hidden;
      -moz-transition: 0.3s height ease;
      -o-transition: 0.3s height ease;
      -webkit-transition: 0.3s height ease;
      transition: 0.3s height ease;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap {
        height: 55px;
      }
    }
    #frame #sidepanel #profile .wrap img {
      width: 50px;
      border-radius: 50%;
      padding: 3px;
      border: 2px solid #e74c3c;
      height: auto;
      float: left;
      cursor: pointer;
      -moz-transition: 0.3s border ease;
      -o-transition: 0.3s border ease;
      -webkit-transition: 0.3s border ease;
      transition: 0.3s border ease;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap img {
        width: 40px;
        margin-left: 4px;
      }
    }
    #frame #sidepanel #profile .wrap img.online {
      border: 2px solid #2ecc71;
    }
    #frame #sidepanel #profile .wrap img.away {
      border: 2px solid #f1c40f;
    }
    #frame #sidepanel #profile .wrap img.busy {
      border: 2px solid #e74c3c;
    }
    #frame #sidepanel #profile .wrap img.offline {
      border: 2px solid #95a5a6;
    }
    #frame #sidepanel #profile .wrap p {
      float: left;
      margin-left: 15px;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap p {
        display: none;
      }
    }
    #frame #sidepanel #profile .wrap i.expand-button {
      float: right;
      margin-top: 23px;
      font-size: 0.8em;
      cursor: pointer;
      color: #435f7a;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap i.expand-button {
        display: none;
      }
    }
    #frame #sidepanel #profile .wrap #status-options {
      position: absolute;
      opacity: 0;
      visibility: hidden;
      width: 150px;
      margin: 70px 0 0 0;
      border-radius: 6px;
      z-index: 99;
      line-height: initial;
      background: #435f7a;
      -moz-transition: 0.3s all ease;
      -o-transition: 0.3s all ease;
      -webkit-transition: 0.3s all ease;
      transition: 0.3s all ease;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap #status-options {
        width: 58px;
        margin-top: 57px;
      }
    }
    #frame #sidepanel #profile .wrap #status-options.active {
      opacity: 1;
      visibility: visible;
      margin: 75px 0 0 0;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap #status-options.active {
        margin-top: 62px;
      }
    }
    #frame #sidepanel #profile .wrap #status-options:before {
      content: '';
      position: absolute;
      width: 0;
      height: 0;
      border-left: 6px solid transparent;
      border-right: 6px solid transparent;
      border-bottom: 8px solid #435f7a;
      margin: -8px 0 0 24px;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap #status-options:before {
        margin-left: 23px;
      }
    }
    #frame #sidepanel #profile .wrap #status-options ul {
      overflow: hidden;
      border-radius: 6px;
    }
    #frame #sidepanel #profile .wrap #status-options ul li {
      padding: 15px 0 30px 18px;
      display: block;
      cursor: pointer;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap #status-options ul li {
        padding: 15px 0 35px 22px;
      }
    }
    #frame #sidepanel #profile .wrap #status-options ul li:hover {
      background: #496886;
    }
    #frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
      position: absolute;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      margin: 5px 0 0 0;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
        width: 14px;
        height: 14px;
      }
    }
    #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
      content: '';
      position: absolute;
      width: 14px;
      height: 14px;
      margin: -3px 0 0 -3px;
      background: transparent;
      border-radius: 50%;
      z-index: 0;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
        height: 18px;
        width: 18px;
      }
    }
    #frame #sidepanel #profile .wrap #status-options ul li p {
      padding-left: 12px;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #profile .wrap #status-options ul li p {
        display: none;
      }
    }
    #frame #sidepanel #profile .wrap #status-options ul li span.status-circle{
      left: 20px;
    }
    #frame #sidepanel #profile .wrap #status-options ul li#status-online span.status-circle {
      background: #2ecc71;
    }
    #frame #sidepanel #profile .wrap #status-options ul li#status-online.active span.status-circle:before {
      border: 1px solid #2ecc71;
    }
    #frame #sidepanel #profile .wrap #status-options ul li#status-away span.status-circle {
      background: #f1c40f;
    }
    #frame #sidepanel #profile .wrap #status-options ul li#status-away.active span.status-circle:before {
      border: 1px solid #f1c40f;
    }
    #frame #sidepanel #profile .wrap #status-options ul li#status-busy span.status-circle {
      background: #e74c3c;
    }
    #frame #sidepanel #profile .wrap #status-options ul li#status-busy.active span.status-circle:before {
      border: 1px solid #e74c3c;
    }
    #frame #sidepanel #profile .wrap #status-options ul li#status-offline span.status-circle {
      background: #95a5a6;
    }
    #frame #sidepanel #profile .wrap #status-options ul li#status-offline.active span.status-circle:before {
      border: 1px solid #95a5a6;
    }
    #frame #sidepanel #profile .wrap #expanded {
      padding: 100px 0 0 0;
      display: block;
      line-height: initial !important;
    }
    #frame #sidepanel #profile .wrap #expanded label {
      float: left;
      clear: both;
      margin: 0 8px 5px 0;
      padding: 5px 0;
    }
    #frame #sidepanel #profile .wrap #expanded input {
      border: none;
      margin-bottom: 6px;
      background: #32465a;
      border-radius: 3px;
      color: #f5f5f5;
      padding: 7px;
      width: calc(100% - 43px);
    }
    #frame #sidepanel #profile .wrap #expanded input:focus {
      outline: none;
      background: #435f7a;
    }
    #frame #sidepanel #search {
      border-top: 1px solid #32465a;
      border-bottom: 1px solid #32465a;
      font-weight: 300;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #search {
        display: none !important;
      }
    }
    #frame #sidepanel #search label {
      position: absolute;
      margin: 10px 0 0 20px;
    }
    #frame #sidepanel #search input {
      font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
      padding: 10px 0 10px 46px;
      width: calc(100% - 25px);
      border: none;
      background: #32465a;
      color: #f5f5f5;
    }
    #frame #sidepanel #search input:focus {
      outline: none;
      background: #435f7a;
    }
    #frame #sidepanel #search input::-webkit-input-placeholder {
      color: #f5f5f5;
    }
    #frame #sidepanel #search input::-moz-placeholder {
      color: #f5f5f5;
    }
    #frame #sidepanel #search input:-ms-input-placeholder {
      color: #f5f5f5;
    }
    #frame #sidepanel #search input:-moz-placeholder {
      color: #f5f5f5;
    }
    #frame #sidepanel #contacts {
      height: calc(100% - 177px);
      overflow-y: scroll;
      overflow-x: hidden;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #contacts {
        height: calc(100% - 149px);
        overflow-y: scroll;
        overflow-x: hidden;
      }
      #frame #sidepanel #contacts::-webkit-scrollbar {
        display: none;
      }
    }
    #frame #sidepanel #contacts.expanded {
      height: calc(100% - 334px);
    }
    #frame #sidepanel #contacts::-webkit-scrollbar {
      width: 8px;
      background: #2c3e50;
    }
    #frame #sidepanel #contacts::-webkit-scrollbar-thumb {
      background-color: #243140;
    }
    #frame #sidepanel #contacts ul li.contact {
      position: relative;
      padding: 10px 0 15px 0;
      font-size: 0.9em;
      cursor: pointer;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #contacts ul li.contact {
        padding: 6px 0 46px 8px;
      }
    }
    #frame #sidepanel #contacts ul li.contact:hover {
      background: #32465a;
    }
    #frame #sidepanel #contacts ul li.contact.active {
      background: #32465a;
      border-right: 5px solid #435f7a;
    }
    #frame #sidepanel #contacts ul li.contact.active span.contact-status {
      border: 2px solid #32465a !important;
    }
    #frame #sidepanel #contacts ul li.contact .wrap {
      width: 88%;
      margin: 0 auto;
      position: relative;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #contacts ul li.contact .wrap {
        width: 100%;
      }
    }
    #frame #sidepanel #contacts ul li.contact .wrap span {
      position: absolute;
      left: 0;
      margin: -2px 0 0 -2px;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      border: 2px solid #2c3e50;
      background: #95a5a6;
    }
    #frame #sidepanel #contacts ul li.contact .wrap span.online {
      background: #2ecc71;
    }
    #frame #sidepanel #contacts ul li.contact .wrap span.away {
      background: #f1c40f;
    }
    #frame #sidepanel #contacts ul li.contact .wrap span.busy {
      background: #e74c3c;
    }
    #frame #sidepanel #contacts ul li.contact .wrap img {
      width: 40px;
      border-radius: 50%;
      float: left;
      margin-right: 10px;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #contacts ul li.contact .wrap img {
        margin-right: 0px;
      }
    }
    #frame #sidepanel #contacts ul li.contact .wrap .meta {
      padding: 5px 0 0 0;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #contacts ul li.contact .wrap .meta {
        display: none;
      }
    }
    #frame #sidepanel #contacts ul li.contact .wrap .meta .name {
      font-weight: 600;
    }
    #frame #sidepanel #contacts ul li.contact .wrap .meta .preview {
      margin: 5px 0 0 0;
      padding: 0 0 1px;
      font-weight: 400;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      -moz-transition: 1s all ease;
      -o-transition: 1s all ease;
      -webkit-transition: 1s all ease;
      transition: 1s all ease;
    }
    #frame #sidepanel #contacts ul li.contact .wrap .meta .preview span {
      position: initial;
      border-radius: initial;
      background: none;
      border: none;
      padding: 0 2px 0 0;
      margin: 0 0 0 1px;
      opacity: .5;
    }
    #frame #sidepanel #bottom-bar {
      position: absolute;
      width: 100%;
      bottom: 0;
    }
    #frame #sidepanel #bottom-bar button {
      float: left;
      border: none;
      width: 50%;
      padding: 10px 0;
      background: #32465a;
      color: #f5f5f5;
      cursor: pointer;
      font-size: 0.85em;
      font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
    }
    #frame #sidepanel #bottom-bar button.btn-expand{
      display: none;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #bottom-bar button {
        float: none;
        width: 100%;
        padding: 15px 0;
      }
      #frame #sidepanel #bottom-bar button.btn-expand{
      display: block;
    }
    }
    #frame #sidepanel #bottom-bar button:focus {
      outline: none;
    }
    #frame #sidepanel #bottom-bar button:nth-child(1) {
      border-right: 1px solid #2c3e50;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #bottom-bar button:nth-child(1) {
        border-right: none;
        border-bottom: 1px solid #2c3e50;
      }
    }
    #frame #sidepanel #bottom-bar button:hover {
      background: #435f7a;
    }
    #frame #sidepanel #bottom-bar button i {
      margin-right: 3px;
      font-size: 1em;
    }
    @media screen and (max-width: 735px) {
      #frame #sidepanel #bottom-bar button i {
        font-size: 1.3em;
      }
    }

    @media screen and (max-width: 735px) {
      #frame #sidepanel #bottom-bar button span {
        display: none !important;
      }
    }
    #frame .content {
      float: right;
      width: 60%;
      height: 100%;
      overflow: hidden;
      position: relative;
    }
    @media screen and (max-width: 735px) {
      #frame .content {
        width: calc(100% - 58px);
       
      }
    }
    @media screen and (min-width: 900px) {
      #frame .content {
        width: calc(100% - 340px);
      }
    }
    #frame .content .contact-profile {
      width: 100%;
      height: 60px;
      line-height: 60px;
      background: #f5f5f5;
    }
    #frame .content .contact-profile img {
      width: 40px;
      border-radius: 50%;
      float: left;
      margin: 9px 12px 0 9px;
    }
    #frame .content .contact-profile p {
      float: left;
    }
    #frame .content .contact-profile .social-media {
      float: right;
    }
    #frame .content .contact-profile .social-media i {
      margin-left: 14px;
      cursor: pointer;
    }
    #frame .content .contact-profile .social-media i:nth-last-child(1) {
      margin-right: 20px;
    }
    #frame .content .contact-profile .social-media i:hover {
      color: #435f7a;
    }
    #frame .content .messages {
      height: auto;
      min-height: calc(100% - 93px);
      max-height: calc(100% - 93px);
      overflow-y: scroll;
      overflow-x: hidden;
    }
    @media screen and (max-width: 735px) {
      #frame .content .messages {
        max-height: calc(100% - 105px);
      }
    }
    #frame .content .messages::-webkit-scrollbar {
      width: 8px;
      background: transparent;
    }
    #frame .content .messages::-webkit-scrollbar-thumb {
      background-color: rgba(0, 0, 0, 0.3);
    }
    #frame .content .messages ul li {
      display: inline-block;
      clear: both;
      float: left;
      margin: 15px 15px 5px 15px;
      width: calc(100% - 25px);
      font-size: 0.9em;
    }
    #frame .content .messages ul li:nth-last-child(1) {
      margin-bottom: 20px;
    }
    #frame .content .messages ul li.sent img {
      margin: 6px 8px 0 0;
    }
    #frame .content .messages ul li.sent p {
      background: #435f7a;
      color: #f5f5f5;
    }
    #frame .content .messages ul li.replies img {
      float: right;
      margin: 6px 0 0 8px;
    }
    #frame .content .messages ul li.replies p {
      background: #f5f5f5;
      float: right;
    }
    #frame .content .messages ul li img {
      width: 22px;
      border-radius: 50%;
      float: left;
    }
    #frame .content .messages ul li p {
      display: inline-block;
      padding: 10px 15px;
      border-radius: 20px;
      max-width: 205px;
      line-height: 130%;
    }
    @media screen and (min-width: 735px) {
      #frame .content .messages ul li p {
        max-width: 300px;
      }
    }
    #frame .content .message-input {
      position: absolute;
      bottom: -6px;
      width: 100%;
      z-index: 99;
    }
    #frame .content .message-input .wrap {
      position: relative;
    }
    #frame .content .message-input .wrap input {
      font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
      float: left;
      border: none;
      width: calc(100% - 90px);
      padding: 11px 32px 10px 8px;
      font-size: 0.8em;
      color: #32465a;
    }
    @media screen and (max-width: 735px) {
      #frame .content .message-input .wrap input {
        padding: 15px 32px 16px 8px;
      }
    }
    #frame .content .message-input .wrap input:focus {
      outline: none;
    }
    #frame .content .message-input .wrap .attachment {
      position: absolute;
      right: 50px;
      z-index: 4;
      margin-top: 10px;
      font-size: 1.1em;
      color: #435f7a;
      cursor: pointer;
      width: 50px;

      background: #ddd;
      opacity: 1;
      height: 45px;

      margin-top: 0;

      text-align: center;

      line-height: 40px;

      color: #090000;

opacity: 1;
    }
    @media screen and (max-width: 735px) {
      #frame .content .message-input .wrap .attachment {
        /*margin-top: 17px;*/
        right: 50px;
      }
    }
    #frame .content .message-input .wrap .attachment:hover {
      opacity: 1;
    }
    #frame .content .message-input .wrap button {
      float: right;
      border: none;
      width: 50px;
      padding: 12px 0;
      cursor: pointer;
      background: #32465a;
      color: #f5f5f5;
    }
    @media screen and (max-width: 735px) {
      #frame .content .message-input .wrap button {
        padding: 16px 0;
      }
    }
    #frame .content .message-input .wrap button:hover {
      background: #435f7a;
    }
    #frame .content .message-input .wrap button:focus {
      outline: none;
    }
    .btn-expand{
      padding: 15px 0;
    }

    .chat-bg {
    /* The image used */
    background-image: url("/assets/chat/images/background.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
  </style>

          <style>
          .sent >div , .replies >div{
            border-radius: 20px;
            padding: 10px 15px;
          }
          .sent >div{
            background: #435f7a; 
            float: right;
            color: #f5f5f5;
            
          }
          .replies >div{
            background: #f5f5f5;
            float: left;
            color: #435f7a;
          }
          #frame .content .messages ul li.sent >div p{
            background: transparent !important;
            padding: 0 !important;
            float: initial !important;
          }
          .sent >div img, .replies >div img{
            width: 50px !important;
            height: 50px !important;
            margin:0 8px !important;
          }
          .sent >div h5, .replies >div h5{
            font-size: 1.25rem !important;
            font-weight: 500;
            line-height: 1.2;
          }
          .sent >div h6, .replies >div h6{
            font-size: 1rem !important;
            margin-bottom: 10px;
            font-family: inherit;
            font-weight: 600;
            line-height: 25px;
            color: inherit;
          } 
          .sent >div textarea, .replies >div textarea{
            margin-bottom: 8px;
          }
          .sent >div textarea{
            background: #f7f8f9
          }
          .sent >div .bg-light{
            background: #47698a!important;
                border: #2e4052 !important;
              margin: 10px 0;
              border-radius: 10px;
          }
          .sent .btn-danger, .replies .btn-danger{
                color: #fff;
              background-color: #fd8469;
              border-color: #fd8469;
          }
        </style>
  {!! Theme::css('chat/css/chat-rtl.css') !!}
</head>
<body>

<div id="frame" class="show-menu">
  <div id="sidepanel">
    <div id="profile">
      <div class="wrap">
        <img id="profile-img" src="{{user()->picture_thumb}}" class="online" alt="{{user()->name}}" />
        <p>{{user()->name}}</p>
   {{--      <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
        <div id="status-options">
          <ul>
            <li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
            <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
            <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
            <li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
          </ul>
        </div>
        <div id="expanded">
          <label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
          <input name="twitter" type="text" value="mikeross" />
          <label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
          <input name="twitter" type="text" value="ross81" />
          <label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
          <input name="twitter" type="text" value="mike.ross" />
        </div> --}}
      </div>
    </div>
    <hr>
  {{--   <div id="search">
      <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
      <input type="text" placeholder="Search contacts..." />
    </div> --}}

     @include('messanger.partials.peoplelist')

    <div id="bottom-bar">
      {{-- <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
      <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button> --}}
      <button class="btn-expand"><i class="fa fa-expand"></i></button>
    </div>
  </div>

@if($show_conversation)
  <div class="content">
    <div class="contact-profile">
      <img src="{{$user->picture_thumb}}" alt="{{$user->name}}" />
      <p>{{$user->name}}</p>

    {{--   <div class="social-media">
        <i class="fa fa-facebook" aria-hidden="true"></i>
        <i class="fa fa-twitter" aria-hidden="true"></i>
         <i class="fa fa-instagram" aria-hidden="true"></i>
      </div> --}}
    </div>
    <div class="messages">
       @yield('content')
    
    </div>
    <div class="message-input">
      <div class="wrap">
          <form action="" method="post" id="talkSendMessage">
              <input type="text" name="message-data" id="message-data" placeholder="اكتب  رسالتك هنا..." autocomplete="off"/>
              <input type="hidden" name="_id" value=@if($user)"{{$user->id}}"@endif>
      {{-- <i class="fa fa-paperclip attachment" aria-hidden="true"></i> --}}
       <a class="attachment show_recorder_btn"><i class="fa fa-microphone" aria-hidden="true"></i></a>
      <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
   
      </form>
    
      </div>
    </div>
  </div>
  @else

  <div class="content chat-bg">
  
  </div>  

@endif

</div>

{!! Theme::js('chat/js/jquery-3.3.1.min.js') !!}
{!! Theme::js('chat/js/bootstrap.min.js') !!}
{!! Theme::js('chat/js/hoy3lrg.js') !!}
@include('messanger.partials.recorder_modal', ['user' => $user])
@include('messanger.partials.recorder_scripts')


   <script>
          var __baseUrl = "{{url('/')}}"
      </script>
 <script>

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      });
    </script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

<script >
  $(".messages").animate({ scrollTop: $(document).height() }, "fast");

  $("#profile-img").click(function() {
    $("#status-options").toggleClass("active");
  });

  $(".expand-button").click(function() {
    $("#profile").toggleClass("expanded");
    $("#contacts").toggleClass("expanded");
  });

  $("#status-options ul li").click(function() {
    $("#profile-img").removeClass();
    $("#status-online").removeClass("active");
    $("#status-away").removeClass("active");
    $("#status-busy").removeClass("active");
    $("#status-offline").removeClass("active");
    $(this).addClass("active");
    
    if($("#status-online").hasClass("active")) {
      $("#profile-img").addClass("online");
    } else if ($("#status-away").hasClass("active")) {
      $("#profile-img").addClass("away");
    } else if ($("#status-busy").hasClass("active")) {
      $("#profile-img").addClass("busy");
    } else if ($("#status-offline").hasClass("active")) {
      $("#profile-img").addClass("offline");
    } else {
      $("#profile-img").removeClass();
    };
    
    $("#status-options").removeClass("active");
  });

  // function newMessage() {
  //   message = $(".message-input input").val();
  //   if($.trim(message) == '') {
  //     return false;
  //   }
  //   $('<li class="sent"><img src="chat/images/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
  //   $('.message-input input').val(null);
  //   $('.contact.active .preview').html('<span>You: </span>' + message);
  //   $(".messages").animate({ scrollTop: $(document).height() }, "fast");
  // };

  // $('.submit').click(function() {
  //   newMessage();
  // });

  // $(window).on('keydown', function(e) {
  //   if (e.which == 13) {
  //     newMessage();
  //     return false;
  //   }
  // });
</script>


<script type="text/javascript">

    $('.btn-expand').click(function(e){
     var sideWidth = $('#frame #sidepanel'); 
    if( sideWidth.width() < 59){
       sideWidth.css({'width':'auto' , 'min-width': '280px','transition':'0.3s'});

       $('#frame #sidepanel #contacts ul li.contact .wrap .meta').css({'display':'block','transition':'0.3s'});

       var xwidth = $('#frame .content').width() - sideWidth.width() +57 +'px';
       $('#frame .content').css({'width': xwidth ,'transition':'0.3s'});
       $('#frame .content .messages ul li p').css({'max-width':'360px'});
        $('#frame #sidepanel #contacts ul li.contact').css({'padding' :'10px 0 15px 0'});
        $('#frame #sidepanel #bottom-bar button').css({'float':'left', 'width':'33.33%'});
        $('#frame #sidepanel #bottom-bar button span, #frame #sidepanel #search').css('display','block');
        $('#frame .content .contact-profile .social-media').css('display','none');
        $('#frame #sidepanel #contacts ul li.contact .wrap img').css('margin','0 ');
    }
    else{
      sideWidth.css({'width':'58px' , 'min-width': '58px','transition':'0.3s'}); 
      $('#frame #sidepanel #contacts ul li.contact .wrap .meta').css({'display':'none','transition':'0.3s'});
      $('#frame .content').css({'width':'calc(100% - 58px)' ,'transition':'0.3s'});
      $('#frame #sidepanel #contacts ul li.contact').css({'padding' :'6px 0 46px 8px'});
      $('#frame #sidepanel #bottom-bar button').css({'float':'none', 'width':'100%'});
      $('#frame #sidepanel #bottom-bar button span, #frame #sidepanel #search').css('display','none');
      $('#frame .content .contact-profile .social-media').css('display','block');
      $('#frame #sidepanel #contacts ul li.contact .wrap img').css('margin','5px !important');
    }
  });
</script>

{!! Theme::js('chat/js/talk.js') !!}

    <script>
        var show = function(data) {
            alert(data.sender.name + " - '" + data.message + "'");
        }

        var msgshow = function(data) {
            var html = '<li class="sent" id="message-' + data.id + '" style="text-align: right; direction: rtl;">' +
            '<div class="message-data">' +
            '<span class="message-data-name"> <a href="#" class="talkDeleteMessage" data-message-id="' + data.id + '" title="Delete Messag"><i class="fa fa-close" style="margin-right: 3px;"></i></a>' + data.sender.name + '</span>' +
            '<span class="message-data-time">1 Second ago</span>' +
            '</div>' +
            '<div class="message my-message">' +
            data.message +
            '</div>' +
            '</li>';

            $('#talkMessages').append(html);
        }

    </script>
    {!! talk_live(['user'=>["id"=>auth()->user()->id, 'callback'=>['msgshow']]]) !!}

</body></html>