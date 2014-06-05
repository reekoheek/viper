![Viper](https://github.com/krisanalfa/viper/raw/master/www/img/viper.png)

# Viper
Viper is e **V** erything **I** s **PER** mitted, a simple blog management system written in PHP.
Post something in markdown style, and you'll set to publish. I create this one for my beloved friends, Subhan Toba.
So people now can write what is in their mind via a fun blogging system.
Viper is free and should always be free.

# Philosophy
The main idea is create a simple blog management system, which you can feel happy when you write some text line by line.

# Requirement and Installation

### The requirement
- PHP >= 5.3
- Composer
- MongoDB
- PHP Mongo Client

### Installation
- Clone
- Run `composer install -vvv`
- Install MongoDb
- Install PHP Mongo Client
- Link the `www` to somewhere inside your web server path
- It's like a Joomla, Wordpress, or something like it's the first time you access the web. No config, so fill the author form
- For first time, you may connect to internet to get your gravatar image id (see in FAQ), so it take some times depends on your internet connection
- Ready to set

# Templating
Viper use Blade Template Engine. You must have a basic knowledge of Blade Layouting and Bono Templating before you start to change the template. The base layout is defined in `/templates/layout.blade.php`
```php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', $meta['title'])</title>

    <!-- SOME META -->

    <!-- FAVICON -->

    <!-- BASE PAGE STYLE -->

    <!-- CUSTOM PAGE STYLE -->
</head>

<body>
    <!-- NAVBAR GOES HERE -->

    <div class="le-content">
        <!-- ALERT SECTION -->
        {{ f('notification.show') }}
        <!-- END OF ALERT SECTION -->

        <!-- CONTENT GOES HERE -->
    </div>

    <!-- BASE JAVASCRIPT FILES -->

    <!-- CUSTOM JAVASCRIPT FILES YOU WANT TO INJECT -->
</body>
</html>

```

As you see you can:
- Edit the title page by change the `title` section.
- Customize your page appearance by inject your css to `styler` section.
- Customize navbar in `components.navbar` section. You can edit the navbar by editing `/shared/components/navbar.blade.php`
- Put page content to `content` section. Each page has it's unique content page. Read Bono Templating Documentation to find out how it works.
- You can inject any javascript file by append them to `injector` section.

# FAQ
**Please have a time to check TODO.md file to get what's not being there in Viper**

|   Q   |   A   |
|-------|-------|
|What is Viper? | Viper is a carry ranged agility hero. Whoops. I mean, It's a very small and simple blog management system. Using markdown syntax for writing.|
|Why should I use Viper? | If you want a simple blog, share your mind, or maybe code. This is a good choice. Writing entry is so funny and i't really simple.|
|I want to change my identity. How do I do that? | Go to Author tab. Update your account there.|
|How do I create my post? | Go to Entries tab. Create your first entry there.|
|How do I update or delete my post? | Please, Sir, you can do it in Entries tab.|
|Why the avatar didn't shown as I expected? | You have to create a Gravatar ID by your email address in Author configuration.|
|Why some elements doesn't rendered well? | Composer update may help. But if the error still ocured, you may assign an issue. I'll fix as fast as I can.|
|How can I change theme? | See in templating and configuration section.|
|Can I use plain text instead of markdown? | Of course you can!|
|How do Viper attach a picture? | You CAN NOT attach picture to your post via VIPER, but you can use markdown syntax to attach the picture. First, upload your pic to somewhere, and then attach it to your post.|
|Can Viper attach a video? | Of course, you **CAN NOT**. You wanna build a YouTube or what?|
|I don't want use MongoDB, I want to use MySQL or SQL-Lite. | You can change them in config. It's a NORM feautre. But keep in mind, I HAVEN'T test it yet, so you have to create your own schema before you use that database. You must change the Norm config in `./config/chunks/norm.php`|
|I want to change my avatar. | Delete the avatar.jpeg in `./www/img/avatar.jpeg` and put your own there. The prefer dimension is: 80x80.|
|I want to add some feature. Can I? | Of course you can. Read the Developer Notes section.|

# Developer Notes
- Clone this repo
- Create a new branch
- Switch to your new branch
- Write some hack (PHP script follow PSR-2 coding standard)
- Create pull request

# Created By
Krisan Alfa Timur a.k.a [Zeek](https://twitter.com/krisanalfa)

#Contributors
- I hope you're here

# Special Gift for
```
PT. Sagara Xinix Solusitama
```

# LICENSE
```
MIT LICENSE

Copyright (c) 2013 Krisan Alfa Timur (PT. Sagara Xinix Solusitama)

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
```

```
The Viper Image is a trademark from Valve (DotA 2)
```
