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
  `invPrdPrice` decimal(10,2) DEFAULT NULL,
  `invPrdImg` varchar(256) DEFAULT NULL,

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
  `usercod` bigint(13) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `paymentId` varchar(50) DEFAULT NULL,
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
  `quantity` bigint(13) NOT NULL,
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
    on update no action
);


CREATE TABLE `shopping_session` (
  `shopSessionId` bigint(13) NOT NULL AUTO_INCREMENT,
  `usercod` bigint(13) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `modified_at` date DEFAULT NULL,

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
  `quantity` bigint(13) NOT NULL,
  `created_at` date DEFAULT NULL,
  `modified_at` date DEFAULT NULL,

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
  `created_at` date DEFAULT NULL,
  `modified_at` date DEFAULT NULL,

    primary key(`paymentId`),

    constraint fk_paymentdetails_orderdetails
    foreign key (orderId)
    references softwarelat_db.order_details (orderId)
    on delete no action
    on update no action
);
 
