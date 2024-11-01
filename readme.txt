=== Plugin Name ===
Contributors: DaHouseCat
Donate link: http://blog.dahousecat.net/twittifier/
Tags: twitter, estadisticas, statistics, bit.ly, spanish, notifier, shorten url, twitter this, twitter post, twitter it, short url
Requires at least: 2.7.1
Tested up to: 2.8
Stable tag: 2.0

== Description ==
Twittifier! es un plugin de Wordpress, que utiliza las Api's de Bit.ly y Twitter para realizar notificaciones en Twitter que puedan ser traceadas y así conocer a que enlaces le dieron clic tus Followers en Twitter.

No requiere de otros plugins para trabajar y esta hecho para integrarse con Wordpress sin dependencias externas complicadas.

NOTA IMPORTANTE: SI TU CUENTA DE BIT.LY ES NUEVA, PRIMERO TIENES QUE ACORTAR UNA URL DESDE EL PANEL DE BIT.LY, APARENTEMENTE ES UNA PROTECCION ANTI-BOT DE BIT.LY

Si quieres puedes seguirme en Twitter, [@DaHouseCat](http://twitter.com/DaHouseCat "El Twitter de DaHouseCat")

== Installation ==

Método de Instalación

   1. Descarga y Descomprime el archivo twittifier.zip
   1. Sube la carpeta completa dentro del directorio wp-plugins
   1. Activa el plugin en el Panel de Administración
   1. En la sección de Opciones estará el Menú Twittifier, desde donde podrás configurar las opciones del plugin.

Método de Actualización

   1. Descarga y Descomprime el archivo twittifier.zip
   1. Desactiva la versión de Twittifier! que tienes instalada
   1. Sube la carpeta completa dentro del directorio wp-plugins, si deseas puedes borrar los archivos anteriores
   1. Activa el plugin en el Panel de Administración
   1. En la sección de Opciones estará el Menú Twittifier!, desde donde podrás configurar las opciones del plugin y mirar las estadísticas.

== Frequently Asked Questions ==

1. He posteado una entrada y no me aparece el link en el twitt ¿que sucedió?

Muy probablemente tu cuenta de bit.ly es nueva, por ello antes de poder utilizar el API, tienes que acortar una url desde tu panel, es decir; te logueas dentro de tu panel y acortas una URL cualquiera así bit.ly sabe que no eres un robot intentando atacar el sistema.

1. ¿Cual es el panel de Explicación?

Es el titulado "Explicación" y muestra una imagen con las partes de un Twitt que podrás configurar con Twittifier!

1. ¿Por que utiliza una tabla en mi base de datos?

Bit.ly pide 3 cosas esenciales para obtener información acerca de un enlace, Usuario, Api Key y un Hash o el Enlace, por ello Twittifier! requiere almacenar estos datos.

1. ¿Cual es el panel de Información Importante?

Es el titulado "Información importante", en el cual se explica que requiere Twittifier! para funcionar y algunas otras cosas.

1. ¿Cual es el panel de Explicación?

Es el titulado "Explicación" y muestra una imagen con las partes de un Twitt que podrás configurar con Twittifier!


1. ¿Que pasará cuando haya twitteado 1000 posts?

Tu decides si deseas eliminar tu historial y solo guardar los necesarios, es decir; si haz puesto que muestre 5 y la base de datos habían 10 solo borrará 5, apartir de la Versión 2.0 de Twittifier! puedes vaciar la base de datos cuando te plazca.

1. ¿Que pasará con la información que Twittifier! almacena en la base de datos, cuando desinstale el plugin?

Puede suceder dos cosas, la primera es que no actives la opción "eliminar tablas a desinstalar" y la información permanezca en la base de datos, si activas "eliminar tablas a desinstalar" no quedará rastro alguno de Twittifier! en tu base de datos.

== Changelog ==

= Twittifier v2.0 =

1. Twitteo de posts programados.
1. Actualización de la tabla de estadísticas cada 5 segundos usando ajax.
1. Ocultamiento de los paneles informativos.
1. Vaciado de la tabla de estadísticas, para que no se sature la base de datos.
1. onfiguración de cuantos enlaces serán mostrados en las estadísticas.
1. Desinstalación total, elimina todo rastro de Twittifier! de tu base de datos.


== Author Notes ==

Plugin Orgullosamente Mexicano U_Un