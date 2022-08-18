<nav x-data="{ open: false }" class="border-gray-100" style="background-color: #000000">
    <!-- Primary Navigation Menu -->
  <div class="d-none d-sm-block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-12 ">
        <div class="flex">
          <!-- Logo -->
          <div class="flex-shrink-0 flex items-center">
              <a href="">
                  <img src="img/iso_enc.png" alt="" style="height:35px">
              </a>
          </div>

          <div class="inline-flex items-center ">
              <p style="margin-bottom: 0; margin-left:10px;">
                  <span style="color: white; font-size:1.3em; font-weight: 300;">
                      <b>Estrella del Plata</b>
                  </span>
                  <span style="color: whitesmoke; font-size:1.1em;"> - Planetario Móvil
                  </span>
              </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-block d-sm-none" style="background-color: rgb(0, 0, 0); text-align:center">
    <div class="flex justify-center h-12 ">
      <div class="flex">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
            <a href="">
                <img src="img/iso_enc.png" alt="" style="height:35px">
            </a>
        </div>

        <div class="inline-flex items-center ">
            <p style="margin-bottom: 0; margin-left:10px;">
                <span style="color: white; font-size:1.1em; font-weight: 300;">
                    <b>Estrella del Plata</b>
            </p>
        </div>
      </div>
    </div>
  </div>


    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="overlay-image" style="background-image:url(/img/slid1.jpg);"></div>
            <div class="containerz">
              <div class="carousel-caption">
                <h1>Una experiencia Inolvidable</h1>
              </div>
            </div>
          </div>

          <div class="carousel-item" >
            <div class="overlay-image" style="background-image:url(/img/slid2.jpg);"></div>
            <div class="containerz">
              <div class="carousel-caption">
                <h1>Para disfrutar en Familia</h1>

              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
</nav>
