#farina


Para el despliegue inicial de la aplicación es necesario hacer la migracion de la base de datos (php artisan migration) para generar las tablas correspondientes y en la sección "tweets" hacer clic en el botón "Actualizar Tweets" para recuperar los 100 tweets iniciales.

Resumen:
La aplicación está desarrollada utilizando Laravel como framework.
Para la base de datos he utilizado MySQL.
Las librerías que he utilizado son ConsoleTVs para mostrar las gráficas, MonkeyLearn para recuperar los sentimientos de los tweets.
Para la recuperación de los tweets he utilizado el paquete "thujohn/twitter".

La aplicación consta de una página inicial con dos enlaces, tweets y gráficas.
En la sección "tweets" se muestra una tabla con los últimos 100 tweets que contengan el hashtag #farina, con un enlace al tweet en Twitter, el tweet, los favoritos, los retweets y un icono representativo en función del sentimiento del tweet. He incluído un botón "Actualizar Tweets" que vacía la tabla tweets y agrega los nuevos últimos 100 tweets y un paginador para mostrarlos en bloques de 20.
En la sección gráficas se muestran gráficas de los 100 últimos tweets, por hora, por favoritos, por sentimiento y el tweet más retweeteado (con su ID).
