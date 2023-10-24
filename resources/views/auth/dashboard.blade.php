@extends('auth.layouts')

@section('content')

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

  <header>
    <div class="container mt-5 col-9 mx-auto mb-5">
      <div class="jumbotron">
        <h1 class="typewriter">Greetings,</h1>
        <hr class="greeting-hr">
        <div class="container-typewritter">
            <span class="text first-text">I'm a </span>
            <span class="text sec-text">Freelancer</span>
        </div>
        <a href="#about" class="btn btn-default btn-find btn-lg mt-3">Find Out More</a>
      </div>
    </div>
  </header>

  <section class="" id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-8 text-end">
          <h2>About Me</h2>
          <hr class="about-hr">
          <p> My name is Rifa Indra Setiawan, a dedicated college student with a love for both the digital world and the gaming realm. As an aspiring front-end web developer, I find joy in bringing creativity to life through code and design.</p>
          <p>Currently, i'm at my 20's age and studied at Gadjah Mada University. As I continue my academic endeavors, I am excited about the prospect of translating my passion for web development and gaming into real-world projects. My goal is to contribute meaningfully to the ever-evolving tech landscape and leave a mark through innovative and user-centric digital experiences</p>
          <p>In my spare time, I engage in various web development projects, constantly honing my skills and pushing the boundaries of what I can create. My portfolio showcases a collection of my work, illustrating my journey and growth as a front-end developer.</p>
        </div>
        <div class="col-md-4">
          <img class="img-responsive img-circle" src="300x300.png" alt="a picture of me">
        </div>
      </div>
    </div>
  </section>

  <section id="skills">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2>Skills</h2>
          <hr class="skills-hr">
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 text-center">
          <div>
            <i class="fa fa-4x fa-laptop text-primary mb-3"></i>
            <h3>Design & Editing</h3>
            <p class="text-muted">Capable of making art both throught design and video</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div>
            <i class="fa fa-4x fa-css3 text-primary mb-3"></i>
            <h3>Web Developer</h3>
            <p class="text-muted">Experienced in creating websites and implementing many frameworks</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div>
            <i class="fa fa-4x fa-globe text-primary mb-3"></i>
            <h3>Up to Date</h3>
            <p class="text-muted">Keep updated and involved in the latest developments in the world, especially technology</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center ">
          <div>
            <i class="fa fa-4x fa-heart text-primary mb-3"></i>
            <h3>Enthusiastic</h3>
            <p class="text-muted">Energetically immersed in the fusion of gaming and front-end web development, my enthusiasm propels me to create captivating digital experiences.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12  col-lg-offset-5 text-center">
          <h2 class="section-heading">Contact Me</h2>
          <hr class="primary">
          <p class="mb-4">Like what you see? I'm readily avalable by e-mail, or you can send me a message through Instagram.</p>
        </div>
        <div class="col-md-4 text-center">
          <i class="fa fa-envelope-o text-primary fa-3x"></i>
          <p><a href="mailto:rifaindrasetiawan@mail.ugm.ac.id">mail.ugm.ac.id</a></p>
        </div>
        <div class="col-md-4 col-lg  text-center">
          <i class="fa fa-instagram text-primary fa-3x"></i>
          <p><a href="https://instagram.com/rifaset">@rifaset</p></a>
        </div>
        <div class="col-md-4 col-lg text-center">
            <i class="fa fa-github text-primary fa-3x"></i>
            <p><a href="https://github.com/rifaset123">Rifa Setiawan</p></a>
        </div>
    </div>

  </div>
  </section>
  <script>
    const text = document.querySelector(".sec-text");
    const textLoad = () => {
        setTimeout(() => {
            text.textContent = "Web Developer";
        }, 0);
        setTimeout(() => {
            text.textContent = "Designer";
        }, 4000);
        setTimeout(() => {
            text.textContent = "Freelancer";
        }, 8000); //1s = 1000 milliseconds
        setTimeout(() => {
            text.textContent = "Gamers";
        }, 12000); //1s = 1000 milliseconds
    }
    textLoad();
    setInterval(textLoad, 12000);
</script>
  <footer class="">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center">
          <p class="copyright">Copyright &copy; rif</p>
        </div>
        <div class="col-md-6">
          <ul class="list-inline text-center">
            <li><a href="https://id.linkedin.com/in/rifa-indra-setiawan-b311a424a"><i class="fa fa-linkedin text-primary"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
@endsection
