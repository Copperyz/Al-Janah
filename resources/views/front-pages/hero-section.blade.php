<style>
    .hero {
    height: 100%;
    background: var(--color-2);
    /* background-image: url("./assets/img/front-pages/landing-page/pexels-daniel-frese-569417.jpg"); */
    object-fit: cover;
    background-size: cover;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 1em;
  }
  /* .hero-frame {
    position: relative;
    display: block;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: green;
  } */
  .hero-title,
  .hero-desc,
  .btn {
    z-index: 1;
  }
  .hero-title {
    color: white;
    /* color: var(--color-3); */
    text-transform: uppercase;
  }
  .hero-title > span {
    /* color: white; */
    color: var(--color-3);
  }
  .hero-desc {
    color: white;
    display: flex;
    flex-direction: column;
    /* color: var(--color-3); */
  }

  .globe,
  .plane,
  .map {
    position: absolute;
    /* max-height: 25vw; */
    z-index: 0;
  }
  .globe {
    transform: rotate(0);
    max-height: clamp(45vw, 300px, 65vw);
    /* filter: drop-shadow(25); */
    /* filter: ; */
    animation: globeRotation 90s infinite 0.2s, fadeInGlobe .8s forwards .2s;
    opacity: 1;
    scale: 0;
    }
  .map {
    transform: rotate(0);
    max-height: clamp(25vw, 170px, 38vw);
    animation: globeRotation 25s infinite reverse, fadeIn .8s forwards .1s;
    opacity: 0;
    scale: 0;
  }
  @keyframes fadeIn {
    0% {
      opacity: 0;
      scale: 0.5;
    }
    100% {
      opacity: 0.8;
      scale: 1;
    }
  }
  @keyframes fadeInGlobe {
    0% {
      opacity: 0;
      scale: 0.5;
    }
    100% {
      opacity: 1;
      scale: 1;
    }
  }
  @keyframes globeRotation {
    0% {
      transform: rotate(0);
    }
    100% {
      transform: rotate(360deg);
    }
  }
  
  .plane {
    max-height: clamp(28vw, 195px, 38vw);
    animation: planeFly 2s forwards;
    opacity: 0;
    transition: opacity 0.3s ease-out 0.3s;
  }
  @keyframes planeFly {
    0% {
      translate: -10vw -15vw;
      /* translate: -160px -120px; */
      opacity: 0;
    }
    30% {
      opacity: 0;
    }
    100% {
      translate: 27vw 16vw;
      /* translate: 220px 250px; */
      opacity: 1;
    }
  }
  @media screen and (max-width: 480px) {
    .globe {
        transform: rotate(0);
        max-height: 167vw;
        filter: drop-shadow(25);
        animation: globeRotation 90s infinite 0.2s, fadeInGlobe .8s forwards .2s;
        opacity: 1;
        scale: 0;
        right: 134px
    }
    .map {
        transform: rotate(0);
        max-height: 100vw;
        animation: globeRotation 25s infinite reverse, fadeIn .8s forwards .1s;
        opacity: 0;
        scale: 0;
        right: 280px;
    }
    .plane {
    max-height: 50vw;
  }
    @keyframes planeFly {
      0% {
        translate: -120vw -150vw;
        opacity: 0;
      }
      30% {
        opacity: 0;
      }
      100% {
        translate: 14vw -80vw;
        opacity: 1;
      }
    }
  }
  
  /* nav elements color : #E4FDE1 */
  /* nav elements color : #4C212A */
  /* nav elements color : #8C271E */
  /* nav elements color : #86524E */
  
  /* @media screen and (max-width: 500px) {
    .globe {
      transform: rotate(0);
      max-height: clamp(60vw, 380px, 75vw);
      min-height: 60vh;
      right: -250px;
      bottom: -220px;
    }
    .map {
      transform: rotate(0);
      max-height: clamp(45vw, 250px, 60vw);
      right: -100px;
      bottom: -80px;
    }
    @keyframes planeFly {
      0% {
        translate: -70px -40px;
        opacity: 0;
      }
      30% {
        opacity: 0;
      }
      100% {
        translate: 100px 180px;
        opacity: 1;
      }
    }
  } */
  /* .btn-cta{
    background: transparent;
    border: 2px solid #fff;
    padding: .7em 2em;
    border-radius: 10px;
    color: #fff;
    text-transform: uppercase;
    transition: background .3s ease-out, border .3s ease-out ;
    letter-spacing: .1em;
    font-weight: 700
  }
  .btn-cta:hover, .btn-cta:focus{
    background: #fff;
    color: #171a2a;
    border: 2px solid transparent;
  } */
/* .btn-cta {
  position: relative;
  padding: 10px 20px;
  border-radius: 7px;
  border: 1px solid rgb(61, 106, 255);
  border: 1px solid #8C271E;
  font-size: 14px;
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 2px;
  background: transparent;
  color: #fff;
  overflow: hidden;
  box-shadow: 0 0 0 0 transparent;
  -webkit-transition: all 0.2s ease-in;
  -moz-transition: all 0.2s ease-in;
  transition: all 0.2s ease-in;
}

.btn-cta:hover {
  background: #8C271E;
  background: rgb(61, 106, 255);
  box-shadow: 0 0 30px 5px rgba(0, 142, 236, 0.815);
  -webkit-transition: all 0.2s ease-out;
  -moz-transition: all 0.2s ease-out;
  transition: all 0.2s ease-out;
}

.btn-cta:hover::before {
  -webkit-animation: sh02 0.5s 0s linear;
  -moz-animation: sh02 0.5s 0s linear;
  animation: sh02 0.5s 0s linear;
}

.btn-cta::before {
  content: '';
  display: block;
  width: 0px;
  height: 86%;
  position: absolute;
  top: 7%;
  left: 0%;
  opacity: 0;
  background: #fff;
  box-shadow: 0 0 50px 30px #fff;
  -webkit-transform: skewX(-20deg);
  -moz-transform: skewX(-20deg);
  -ms-transform: skewX(-20deg);
  -o-transform: skewX(-20deg);
  transform: skewX(-20deg);
} */
.btn-cta {
  padding: 1em 2em;
  border: none;
  border-radius: 5px;
  font-weight: bold;
  letter-spacing: 5px;
  text-transform: uppercase;
  cursor: pointer;
  color: #fff;
  transition: all 1000ms;
  font-size: 15px;
  position: relative;
  overflow: hidden;
  outline: 2px solid #8C271E;
}

.btn-cta:hover {
  color: #ffffff;
  transform: scale(1.05);
  outline: 2px solid #8C271E;
  box-shadow: 4px 5px 17px -4px #8C271E;
}

.btn-cta::before {
  content: "";
  position: absolute;
  left: -50px;
  top: 0;
  width: 0;
  height: 100%;
  background-color: #8C271E;
  transform: skewX(45deg);
  z-index: -1;
  transition: width 1000ms;
}

.btn-cta:hover::before {
  width: 250%;
}

@keyframes sh02 {
  from {
    opacity: 0;
    left: 0%;
  }

  50% {
    opacity: 1;
  }

  to {
    opacity: 0;
    left: 100%;
  }
}

.btn-cta:active {
  box-shadow: 0 0 0 0 transparent;
  -webkit-transition: box-shadow 0.2s ease-in;
  -moz-transition: box-shadow 0.2s ease-in;
  transition: box-shadow 0.2s ease-in;
}

</style>
<div class="hero">
        <!-- animation elements -->
        <!-- <div class="hero-frame"> -->
        <!-- <img class="globe" src="/assets/0-globe-middle.png" alt="jglobe" /> -->
        <!-- <img class="globe" src="/assets/0-globe-dark_1.png" alt="jglobe" /> -->
        <div style="display: flex; justify-content:center; align-items:center">
          <img
            class="globe"
            src="{{asset('assets/img/front-pages/landing-page/0-globe-dark_1.avif')}}"
            alt="jglobe" />
          <!-- <img class="globe" src="/assets/0-globe-exclusion.png" alt="jglobe" /> -->
          <!-- <img class="map" src="/assets/map-centered.png" alt="jmap" /> -->
          <img class="map" src="{{asset('assets/img/front-pages/landing-page/map.avif')}}" alt="jmap" />
        </div>
        <h2 class="hero-title">Your Goods,<br><span style="padding-left: 3em"> Our Mission</span>.</h2>
        <div class="hero-desc text-center">
            <h4 style="color:#fff !important">Track Your Cargo From Anywhere</h4>
            <a href="{{route('track-shipment')}}" class="btn-cta">Track Shipment</a>
        </div>
        <!-- <img class="plane" src="/assets/0-plane-dark@2x.png" alt="jplane" /> -->
        <!-- <img class="plane" src="/assets/0-plane-dark@2x.png" alt="jplane" /> -->
        <img
          class="plane"
          src="{{asset('assets/img/front-pages/landing-page/0-plane-dark@2x.avif')}}"
          alt="jplane" />

        <!-- </div> -->
        <!-- title - description - cta -->
</div>