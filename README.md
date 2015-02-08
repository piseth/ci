# My Codeigniter
this my example of using codeigniter 2.2.0

### Database

CREATE TABLE news (
	id int(11) NOT NULL AUTO_INCREMENT,
	title varchar(128) NOT NULL,
	slug varchar(128) NOT NULL,
	text text NOT NULL,
	PRIMARY KEY (id),
	KEY slug (slug)
);

CREATE TABLE `users` (
 `id` tinyint(4) NOT NULL AUTO_INCREMENT,
 `username` varchar(10) NOT NULL,
 `password` varchar(100) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

insert into users (username, password) values ('bob', MD5('supersecret'));
