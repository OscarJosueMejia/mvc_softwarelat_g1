drop database if exists softwarelat_db;

create database if not exists softwarelat_db;
use softwarelat_db;

/*EXTRAIDO DE MVC SIMPLE ORIGINAL*/
CREATE TABLE `clientes` (
  `clientid` bigint(15) NOT NULL AUTO_INCREMENT,
  `clientname` varchar(128) DEFAULT NULL,
  `clientgender` char(3) DEFAULT NULL,
  `clientphone1` varchar(255) DEFAULT NULL,
  `clientphone2` varchar(255) DEFAULT NULL,
  `clientemail` varchar(255) DEFAULT NULL,
  `clientIdnumber` varchar(45) DEFAULT NULL,
  `clientbio` varchar(5000) DEFAULT NULL,
  `clientstatus` char(3) DEFAULT NULL,
  `clientdatecrt` datetime DEFAULT NULL,
  `clientusercreates` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`clientid`)
) ENGINE=InnoDB;

CREATE TABLE `usuario` (
  `usercod` bigint(10) NOT NULL AUTO_INCREMENT,
  `useremail` varchar(80) DEFAULT NULL,
  `username` varchar(80) DEFAULT NULL,
  `userpswd` varchar(128) DEFAULT NULL,
  `userfching` datetime DEFAULT NULL,
  `userpswdest` char(3) DEFAULT NULL,
  `userpswdexp` datetime DEFAULT NULL,
  `userest` char(3) DEFAULT NULL,
  `useractcod` varchar(128) DEFAULT NULL,
  `userpswdchg` varchar(128) DEFAULT NULL,
  `usertipo` char(3) DEFAULT NULL COMMENT 'Tipo de Usuario, Normal, Consultor o Cliente',
  PRIMARY KEY (`usercod`),
  UNIQUE KEY `useremail_UNIQUE` (`useremail`),
  KEY `usertipo` (`usertipo`,`useremail`,`usercod`,`userest`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `roles` (
  `rolescod` varchar(15) NOT NULL,
  `rolesdsc` varchar(45) DEFAULT NULL,
  `rolesest` char(3) DEFAULT NULL,
  PRIMARY KEY (`rolescod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `roles_usuarios` (
  `usercod` bigint(10) NOT NULL,
  `rolescod` varchar(15) NOT NULL,
  `roleuserest` char(3) DEFAULT NULL,
  `roleuserfch` datetime DEFAULT NULL,
  `roleuserexp` datetime DEFAULT NULL,
  PRIMARY KEY (`usercod`,`rolescod`),
  KEY `rol_usuario_key_idx` (`rolescod`),
  CONSTRAINT `rol_usuario_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_rol_key` FOREIGN KEY (`usercod`) REFERENCES `usuario` (`usercod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `funciones` (
  `fncod` varchar(255) NOT NULL,
  `fndsc` varchar(45) DEFAULT NULL,
  `fnest` char(3) DEFAULT NULL,
  `fntyp` char(3) DEFAULT NULL,
  PRIMARY KEY (`fncod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `funciones_roles` (
  `rolescod` varchar(15) NOT NULL,
  `fncod` varchar(255) NOT NULL,
  `fnrolest` char(3) DEFAULT NULL,
  `fnexp` datetime DEFAULT NULL,
  PRIMARY KEY (`rolescod`,`fncod`),
  KEY `rol_funcion_key_idx` (`fncod`),
  CONSTRAINT `funcion_rol_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rol_funcion_key` FOREIGN KEY (`fncod`) REFERENCES `funciones` (`fncod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `bitacora` (
  `bitacoracod` int(11) NOT NULL AUTO_INCREMENT,
  `bitacorafch` datetime DEFAULT NULL,
  `bitprograma` varchar(255) DEFAULT NULL,
  `bitdescripcion` varchar(255) DEFAULT NULL,
  `bitobservacion` mediumtext,
  `bitTipo` char(3) DEFAULT NULL,
  `bitusuario` bigint(18) DEFAULT NULL,
  PRIMARY KEY (`bitacoracod`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

DROP TABLE  `funciones_roles`;
DROP TABLE `funciones`;


CREATE TABLE `funciones` (
  `fncod` varchar(255) NOT NULL,
  `fndsc` varchar(45) DEFAULT NULL,
  `fnest` char(3) DEFAULT NULL,
  `fntyp` char(3) DEFAULT NULL,
  PRIMARY KEY (`fncod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `funciones_roles` (
  `rolescod` varchar(15) NOT NULL,
  `fncod` varchar(255) NOT NULL,
  `fnrolest` char(3) DEFAULT NULL,
  `fnexp` datetime DEFAULT NULL,
  PRIMARY KEY (`rolescod`,`fncod`),
  KEY `rol_funcion_key_idx` (`fncod`),
  CONSTRAINT `funcion_rol_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rol_funcion_key` FOREIGN KEY (`fncod`) REFERENCES `funciones` (`fncod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `bitacora` CHANGE `bitprograma` `bitprograma` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

CREATE TABLE `categorias` (
  `catid` BIGINT(8) NOT NULL AUTO_INCREMENT,
  `catnom` VARCHAR(45) NULL,
  `catest` CHAR(3) NULL DEFAULT 'ACT',
  PRIMARY KEY (`catid`));
  
/*--------------------------------------------------------------*/

CREATE TABLE `productos` (
  `invPrdId` bigint(13) NOT NULL AUTO_INCREMENT,
  `invPrdName` varchar(128) DEFAULT NULL,
  `invPrdDsc` mediumtext DEFAULT NULL,
  `invPrdCat` bigint(8) DEFAULT NULL,
  `invPrdEst` char(3) DEFAULT NULL,
  `invPrdPriceISV` decimal(10,2) DEFAULT NULL,
  `invPrdPrice` decimal(10,2) DEFAULT NULL,
  `invPrdImg` longtext DEFAULT NULL,

    PRIMARY KEY (`invPrdId`),

    constraint fk_invPrdTip_categorias
    foreign key (invPrdCat)
    references softwarelat_db.categorias (catid)
    on delete no action
    on update no action
);

CREATE TABLE `claves_detalle` (
  `invClvId` bigint(13) NOT NULL AUTO_INCREMENT,
  `invPrdId` bigint(13) NOT NULL,
  `invClvSerial` varchar(50) DEFAULT NULL,
  `invClvExp` date DEFAULT NULL,
  `invClvEst` char(3) DEFAULT NULL,

    primary key(`invClvId`),

    constraint fk_clavesdetalle_productos
    foreign key (invPrdId)
    references softwarelat_db.productos (invPrdId)
    on delete no action
    on update no action
);


CREATE TABLE `order_details` (
  `orderId` bigint(13) NOT NULL AUTO_INCREMENT,
  `orderCode` varchar(20) NOT NULL,
  `usercod` bigint(13) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `totalUSD` decimal(10,2) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `modified_at` date DEFAULT NULL,

    primary key(`orderId`),

    constraint fk_orderdetails_usuario
    foreign key (usercod)
    references softwarelat_db.usuario (usercod)
    on delete no action
    on update no action
);

CREATE TABLE `order_item` (
  `orderItemId` bigint(13) NOT NULL AUTO_INCREMENT,
  `orderId` bigint(13) NOT NULL,
  `invPrdId` bigint(13)  DEFAULT NULL,
  `invClvId` bigint(13)  DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `modified_at` date DEFAULT NULL,

    primary key(`orderItemId`),

    constraint fk_orderitem_orderdetails
    foreign key (orderId)
    references softwarelat_db.order_details (orderId)
    on delete no action
    on update no action,

    constraint fk_orderitem_productos
    foreign key (invPrdId)
    references softwarelat_db.productos (invPrdId)
    on delete no action
    on update no action,
    
	constraint fk_orderitem_clavesproductos
    foreign key (invClvId)
    references softwarelat_db.claves_detalle (invClvId)
    on delete no action
    on update no action
);


CREATE TABLE `shopping_session` (
  `shopSessionId` bigint(13) NOT NULL AUTO_INCREMENT,
  `usercod` bigint(13) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,

    primary key(`shopSessionId`),

    constraint fk_shoppingsession_usuario
    foreign key (usercod)
    references softwarelat_db.usuario (usercod)
    on delete no action
    on update no action
);

CREATE TABLE `cart_item` (
  `cartItemId` bigint(13) NOT NULL AUTO_INCREMENT,
  `shopSessionId` bigint(13) NOT NULL,
  `invPrdId` bigint(13) NOT NULL,
  `quantity` bigint(13) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,

    primary key(`cartItemId`),

    constraint fk_cartitem_shoppingsession
    foreign key (shopSessionId)
    references softwarelat_db.shopping_session (shopSessionId)
    on delete no action
    on update no action,

    constraint fk_cartitem_productos
    foreign key (invPrdId)
    references softwarelat_db.productos (invPrdId)
    on delete no action
    on update no action
);

CREATE TABLE `payment_details` (
  `paymentId` bigint(13) NOT NULL AUTO_INCREMENT,
  `orderId` bigint(13) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `providerName` varchar(50) DEFAULT NULL,
  `payStatus` char(3) DEFAULT NULL,
  `orderJSON` text NULL,
  `created_at` date DEFAULT NULL,
  `modified_at` date DEFAULT NULL,

      primary key(`paymentId`),

    constraint fk_paymentdetails_orderdetails
    foreign key (orderId)
    references softwarelat_db.order_details (orderId)
    on delete no action
    on update no action
);

CREATE TABLE `paypal_tokens` (
  `tokenId` bigint(13) NOT NULL AUTO_INCREMENT,
  `usercod` bigint(13) NOT NULL,
  `orderToken` varchar(100) NOT NULL,
  `created_at` date DEFAULT NULL,

	primary key(`tokenId`),

    constraint fk_paypaltoken_usuario
    foreign key (usercod)
    references softwarelat_db.usuario (usercod)
    on delete no action
    on update no action
);
 
 

insert into categorias values(1,'Ejemplo1','ACT');

insert into usuario values(1,null,'usuario1','examplepass',null,null,null,'ACT',null,null,'ADM');
insert into usuario values(2,null,'usuario2','examplepass',null,null,null,'ACT',null,null,'ADM');

insert into productos values(1,'Product1','DescProduct1',1,'ACT',805,700,"https://cdn-icons-png.flaticon.com/512/807/807292.png");
insert into claves_detalle values(1,1,'serialexample1-1','2022-08-28','ACT');
insert into claves_detalle values(2,1,'serialexample1-2','2022-08-28','ACT');
insert into claves_detalle values(3,1,'serialexample1-3','2022-08-28','ACT');
insert into claves_detalle values(10,1,'serialexample1-4','2022-08-28','ACT');

insert into productos values(2,'Product2','DescProduct2',1,'ACT',402.5,350,"https://cdn-icons-png.flaticon.com/512/807/807292.png");
insert into claves_detalle values(4,2,'serialexample2-1','2022-08-28','ACT');
insert into claves_detalle values(5,2,'serialexample2-2','2022-08-28','ACT');
insert into claves_detalle values(6,2,'serialexample2-3','2022-08-28','ACT');

insert into productos values(3,'Product3','DescProduct3',1,'ACT',1357, 1180,"https://cdn-icons-png.flaticon.com/512/807/807292.png");
insert into claves_detalle values(7,3,'serialexample3-1','2022-08-28','ACT');
insert into claves_detalle values(8,3,'serialexample3-2','2022-08-28','ACT');
insert into claves_detalle values(9,3,'serialexample3-3','2022-08-28','ACT');

insert into shopping_session values(1,1,0,now(),now());
insert into cart_item values(1,1,1,2, now(),now());
insert into cart_item values(3,1,2,1, now(),now());

insert into shopping_session values(2,2,0,now(),now());
insert into cart_item values(2,2,1,1, now(),now());

/*Verificar si existen Sesiones de Compra con un tiempo mayor a 3 dias*/
DELIMITER //
CREATE PROCEDURE DeleteShopSessionByTime ()
	BEGIN
		DELETE a
        FROM cart_item a 
        inner join shopping_session b on a.shopSessionId = b.shopSessionId where datediff(now(), b.modified_at) > 3;
        
        DELETE FROM shopping_session where datediff(now(), modified_at) > 3;
	END //
DELIMITER ;


select * from shopping_session;
select * from cart_item;

select * from claves_detalle;

select * from order_details where usercod = 1;
select * from order_item a inner join order_details b on a.orderId = b.orderId where b.usercod = 1;

select a.cartItemId, a.shopSessionId, a.invPrdId, b.invPrdName, b.invPrdPrice, b.invPrdDsc, b.invPrdCat, b.invPrdEst, b.invPrdImg, a.quantity, (b.invPrdPrice * a.quantity) as amount from cart_item a inner join productos b on a.invPrdId = b.invPrdId;

/*Retorna la cantidad de producto disponible para ofrecer*/
SELECT count(*) - (SELECT sum(quantity) from cart_item where invPrdId = 1) as disponibles_venta from claves_detalle where invPrdId = 1 and invClvEst = "ACT" and invClvExp >= now();

/*Verificar que el producto este disponible*/
SELECT count(*) - (SELECT ifnull(sum(quantity),0) from cart_item where invPrdId = 2 and shopSessionId <> 1) as disponibles_venta from claves_detalle where invPrdId = 2 and invClvEst = "ACT" and datediff(invClvExp,now()) > 1 ;


/*Verifica si el producto ya esta en el carrito del usuario*/
SELECT count(a.cartItemId) from cart_item a inner join shopping_session b on a.shopSessionId = b.shopSessionId where invPrdId = 1 and usercod = 1;

/*Sumar los carritos de una shop session*/
SELECT sum(b.invPrdPrice * a.quantity) from cart_item a inner join productos b on a.invPrdId = b.invPrdId where shopSessionId = 1;

/*Extraer las claves*/
SELECT * from claves_detalle where invPrdId = 1 and invClvEst = "ACT" and invClvExp >= now()  order by invClvExp asc limit 1;
 
 /*Detalles del Item de Orden*/
 SELECT a.orderItemId, a.orderId, a.invPrdId, b.invPrdName, b.invPrdDsc, b.invPrdPrice, c.invClvId, c.invClvSerial, c.invClvExp, d.catnom
 FROM order_item a 
 inner join productos b on a.invPrdId = b.invPrdId 
 inner join claves_detalle c on a.invClvId = c.invClvId 
 inner join categorias d on b.invPrdCat = d.catid
 where a.orderId = 1;
 
SELECT * FROM order_details a inner join payment_details b on a.orderId = b.orderId where a.orderId = 1;

/*Delete Cart Items where */
SELECT * FROM shopping_session WHERE datediff(now(), created_at) > 3;
SELECT * FROM cart_item;


call DeleteShopSessionByTime();


SELECT sum(b.invPrdPriceISV * a.quantity) as session_total, sum(b.invPrdPrice * a.quantity) as session_subtotal from cart_item a inner join productos b on a.invPrdId = b.invPrdId where shopSessionId =1;


SELECT * FROM orders