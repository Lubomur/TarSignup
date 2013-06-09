TarSignup
==========
Version 0.0.1 Created by Francisc Tar

INTRODUCTION
=============
TarSignup is a very simple and very basic signup and signin module for Zend Framework 2.

FEATURES
========
- Form Validation (not jQuery)
- Email Autentificacion
- Database Table Authentication
- Remember me checkbox

REQUIREMENTS
=============
- <a href="https://github.com/zendframework/zf2">Zend Framework 2 </a> (latest master)

TODO
=====
- Database session storage
- Unique user login
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
You can add in YourProject -> module -> Application -> view -> application -> index -> index.phtml<br />
After the first \<div class="hero-unit"\> block<br />
Display success messages
<pre>
<?php if(!empty($this->scc)): ?>
    \<div class="span10"\>
        \<ul\>
        <?php foreach ($this->scc as $v): ?>
            \<li\><?php echo $v; ?>\</li\>
        <?php endforeach; ?>
        \</ul\>
    \</div\>
<?php endif; ?>
</pre>
Display error messages
<pre>
<?php if(!empty($this->err)): ?>
    \<div class="span10"\>
        \<ul\>
        <?php foreach ($this->err as $v): ?>
            \<li\><?php echo $v; ?>\</li\>
        <?php endforeach; ?>
       \</ul\>
    \</div\>
<?php endif; ?>
</pre>

And just a little bit of CSS to look nice while we are testing/developing:<br />
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
Don't forget to import users.sql to your database!
- Username: admin
- Passord:  123456

BTW
====
I'm a noob in ZF2. So, be gentle. ;) Have a nice day.