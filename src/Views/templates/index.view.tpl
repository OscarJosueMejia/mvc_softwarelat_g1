<!-- Page Content -->
  <!-- Banner Starts Here -->
  <div class="banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="caption">
            <h2>Softwarelat Honduras</h2>
            <div class="line-dec"></div>
            <p>
              Softwarelat es una empresa nacida
              en Honduras con el objetivo de
              brindar soluciones de software
              legal así como soporte técnico del
              área de TI.
              Ofrecemos licencias de software,
              programas informaticos, sistemas
              operativos.
              <br>
              <br>
              <strong> ¡Para nosotros es un placer
              atenderle! </strong>
            </p>
            <div class="main-button">
              <a href="#">VER PRODUCTOS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Ends Here -->

  <!-- Featured Starts Here -->
  <div class="featured-items">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>Productos Destacados</h1>
          </div>
        </div>
        <div class="col-md-12">
          <div class="owl-carousel owl-theme">
            {{foreach Productos}}
            <a href="index.php?page=productos_detalle&id={{invPrdId}}">
              <div class="featured-item">
                <img src="{{invPrdImg}}" alt="{{invPrdId}}">
                <p class="mt-2">{{catnom}}</p>
                <h4>{{invPrdName}}</h4>
                <h6>L. {{invPrdPriceISV}}</h6>
              </div>
            </a>
            {{endfor Productos}}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Featred Ends Here -->

  <!-- Why Choose Here -->
  <div class="why-choose">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h1 class="text-center">¿Por qué elegirnos?</h1>
          </div>
        </div>
        <div class="container-wc">
          <div class="detail-wc col-sm-12 col-md-4">
            <div>
              <h5>Garantía de activación</h5>
              <span><i class="icon-wc fa fa-life-ring" aria-hidden="true"></i></span>
              <p>Si tienes inconvenientes al activar tu producto te ofrecemos soporte virtual de activación.</p>
            </div>
          </div>
          <div class="detail-wc col-sm-12 col-md-4">
            <h5>Soporte de activación</h5>
            <span><i class="icon-wc fas fa-headset" aria-hidden="true"></i></span>
            <p>Te aseguramos que tu producto quedará activo y en funcionamiento.</p>
          </div>
          <div class="detail-wc col-sm-12 col-md-4">
            <h5>Precios accesibles</h5>
            <span><i class="icon-wc fas fa-heart" aria-hidden="true"></i></span>
            <p>Tenemos opciones asequibles para que puedes legalizar tu software a los mejores precios.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Why Choose Here -->

  <!-- FAQ Here -->
  <div class="faq">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h1 class="text-center">Preguntas frecuentes</h1>
            <p class="text-center" >Preguntas sobre los detalles de la prestación de servicios, productos, entrega y cuestiones similares.</p>
          </div>
        </div>
        <div class="container-faq">
          <div class="detail-faq col-sm-12 col-md-4">
              <h5>¿QUé vende Sofwarelat? </h5>
              <br>
              <br>
              <p>En Softwarelat te ofrecemos licencias digitales de software, como Windows 10, Microsoft Office. Asi tambien claves de juegos para Xbox, PC y soporte de TI para tu equipo.</p>
          </div>
          <div class="detail-faq col-sm-12 col-md-4">
            <h5>¿Softwarelat ofrece garantía en sus productos?</h5>
            <br>
            <p>En Softwarelat nos tomamos en serio la responsabilidad de ofrecerte el servicio mas seguro y fiable, por lo tanto claro que ofrecemos garantia y opciones de reembolso limitado.</p>
          </div>
          <div class="detail-faq col-sm-12 col-md-4">
            <h5>¿Dónde están ubicados?</h5>
            <br>
            <br>
            <p>Trabajamos como una tienda totalmente virtual donde tu compra no tiene que esperar días u horas a ser entregada, desde tu pedido, activación y soporte se realiza de manera rápida y fácil por internet.</p>
          </div>
        </div>
        <h5 style="margin-top: -35px;" class="col-md-12 text-center">¿Tienes Preguntas Adicionales?</h5>
        <div class="main-button m-auto">
          <a style="margin-bottom: 45px; justify-content: center;" href="https://api.whatsapp.com/send?phone=50498753532" role="button" target="_blank">Contactar Asesor</a>
        </div>
      </div>
    </div>
  </div>
  <!-- FAQ Here -->

  <!-- Subscribe Form Starts Here -->
  <div class="subscribe-form">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h1>Suscribete a nuestro boletin</h1>
          </div>
        </div>
        <div class="col-md-8 offset-md-2">
          <div class="main-content">
            <p>Recibir las mejores ofertas y novedades de Softwarelat Honduras para tener a punto tus dispostivos.</p>
            <div class="container">
              <form id="subscribe" action="" method="get">
                <div class="row">
                  <div class="col-md-7">
                    <fieldset>
                      <input name="email" type="text" class="form-control" id="email" placeholder="Correo electrónico..." required="">
                    </fieldset>
                  </div>
                  <div class="col-md-5">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button">Suscribirse Ahora</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Subscribe Form Ends Here -->
