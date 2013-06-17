TarSignup
==========
Version 0.0.9 Created by Francisc Tar

INTRODUCTION
=============
TarSignup is a very simple and very basic signup and signin module for Zend Framework 2.

FEATURES
========
- Form Validation (not jQuery)
- Email Autentificacion
- Database Table Authentication
- Database session storage
- Remember me checkbox
- Unique user login

REQUIREMENTS
=============
- <a href="https://github.com/zendframework/zf2">Zend Framework 2 </a> (latest master)

TODO
=====
- Forgot password
- Multilanguage
- ...

INSTALATION
============
- Copy TarSignup folder in YourProject -> module
- In YourProject -> config -> application.config.php
<pre>
'modules' => array(
    'Application',
    'TarSignup',  <- Add this line
),
</pre>

Now you are good to go.

- Optional<br />
Just a little bit of CSS to look nice while we are testing/developing:<br />
YourProject -> public -> css -> style.css<br />
Add this lines:
<pre>
input {
  float:right;
}
label {
  float:left;
}
form {
  width: 500px
}
ul {
  position:relative;
  float:left;
  color:red;
}
.btn {
  margin-right:20px;
}
</pre>

Testing
========
Don't forget to import users.sql and session.sql to your database!
- Username: admin
- Passord:  123456

BTW
====
I'm a noob in ZF2. So, be gentle. ;) Have a nice day.
