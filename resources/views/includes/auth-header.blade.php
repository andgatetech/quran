<style>

.logo img {
    width: 80px;
    height: 80px;
    margin-bottom: 20px;
  }
  @media (min-width: 768px) {
    .logo img {
      width: 100px;
      height: 100px;
    }
  }



  /* Welcome Text */
  .welcome-text {
    font-size: 18px;
    color: var(--secondary-color);;
    margin-bottom: 30px;
    line-height: 1.5;
  }

  @media (min-width: 768px) {
    .welcome-text {
      font-size: 22px;
    }
  }



</style>


<div class="logo">
    <img src="{{ asset('public/assets/img/logo.png') }}"  alt="Magey Competition Logo">
  </div>
  <h1 class="welcome-text">Welcome to,<br>Magey Competition</h1>
