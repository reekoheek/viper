@section('content')
<?php use \Bono\Helper\URL; ?>

<div class="container" style="margin-bottom: 50px">
    <div class="row">
        <img src="{{ URL::base('/img/viper.png') }}" alt="" class="logo" style="">
    </div>
    <h1 class="text-center">VIPER <small>eVerything Is PERmitted</small></h1>
    <h2 class="text-center">Made by <i class="fa fa-heart"></i> and PHP</h2>
</div>

<hr />

<div class="container" style="margin: 50px 0">
    <p class="text-center">
        I create this one for my beloved friends, Subhan Toba. So people now can write
        what is in their mind via a fun blogging system.
        <br />
        If you want to contribute to this project, you can follow this project via GitHub.
        You can fork, create a new branch, do some magic, and create a pull request.
        <br />
        If you find some errors or maybe you have a wish there's a feature inside Viper and you
        cannot write a code, you can follow the milestone via GitHub too. Go to issue page, and
        create a new issue there.
    </p>
</div>

<hr />

<div class="container" style="margin: 50px 0 0 0">
    <h2 class="text-center"><small>Creative by Krisan Alfa Timur</small></h2>
    <div class="text-center">
        <a href="#"><i class="fa fa-github fa-2x"></i></a>
        <a href="#"><i class="fa fa-twitter fa-2x"></i></a>
        <a href="#"><i class="fa fa-facebook fa-2x"></i></a>
    </div>
    <h4 class="text-center"><small>PT. Sagara Xinix Solusitama</small></h4>
</div>

@endsection
