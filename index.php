<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MataHati</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>


  <!-- Preloader -->
  <!-- <div class="preloader">
      <div class="loading">
        <div class="spinner-border" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div> -->

  <div class="animate__animated animate__fadeInDown">
    <?php include "./comp/navbar.html" ?>

  </div>
  <div data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true">

    <!-- home section -->
    <section class="home " id="home">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="text animate__animated animate__fadeInLeft animate__delay-1s">
              <h1>
                We Provide <span>Computer Vision</span> to Perfect the
                <span>Experience</span>
              </h1>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris
                sed nisl pellentesque, faucibus libero eu, gravida quam.
              </p>
              <div class="button">
                <a href="./assets/img/demo matahati - Made with Clipchamp.mp4" class="btn primary">Demo Mata Hati</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 animate__animated animate__fadeInRight animate__delay-1s">
            <div class="hero-image ">
              <img src="./assets/img/hero.png" alt="Computer Vision Illustration" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- stories section -->
    <section class="stories" id="stories">
      <div class="container">
        <div class="section-header text-center" data-aos="fade-down">
          <h2>What They Say About <span>MataHati</span></h2>
          <p class="subtitle">Discover how MataHati has transformed businesses through computer vision technology</p>
        </div>

        <div class="row g-4 mt-4">
          <!-- Testimonial Card 1 -->
          <div class="col-lg-4 col-md-6" data-aos="flip-left" data-aos-delay="500">
            <div class="testimonial-card">
              <div class="profile">
                <img src="./assets/img/testimonial1.jpeg" alt="John Doe" class="profile-img">
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
              </div>
              <div class="content">
                <p class="testimony">"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cumque natus reiciendis tempora sunt officia possimus asperiores, officiis odit quae laboriosam."</p>
                <div class="user-info">
                  <h5>John Doe</h5>
                  <span>Matahati member since 02-02-2020</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Testimonial Card 2 -->
          <div class="col-lg-4 col-md-6" data-aos="flip-left" data-aos-delay="1000">
            <div class="testimonial-card">
              <div class="profile">
                <img src="./assets/img/testimonial1.jpeg" alt="Sarah Johnson" class="profile-img">
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </div>
              </div>
              <div class="content">
                <p class="testimony">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, ducimus non! Modi exercitationem fugit magnam itaque, eos natus ratione esse."</p>
                <div class="user-info">
                  <h5>Sarah Johnson</h5>
                  <span>Matahati member since 02-02-2020</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Testimonial Card 3 -->
          <div class="col-lg-4 col-md-6" data-aos="flip-left" data-aos-delay="1500">
            <div class="testimonial-card">
              <div class="profile">
                <img src="./assets/img/testimonial1.jpeg" alt="Alex Chen" class="profile-img">
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
              </div>
              <div class="content">
                <p class="testimony">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque delectus magni, est eum eius laboriosam eligendi molestiae tempora quaerat amet!"</p>
                <div class="user-info">
                  <h5>Alex Chen</h5>
                  <span>Matahati member since 02-02-2020</span>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>

    <!-- services section -->
    <section class="services" id="services">
      <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
          <h2>Our <span>Services</span></h2>
          <p class="subtitle">Connecting visually impaired individuals with nearby volunteers through smart phone technology</p>
        </div>

        <div class="row g-4 mt-4" data-aos="fade-down">
          <!-- Main Feature Highlight -->
          <div class="col-12 mb-5">
            <div class="feature-highlight">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <div class="feature-content">
                    <div class="feature-badge">Main Feature</div>
                    <h3>Instant Volunteer Connection</h3>
                    <p class="feature-desc">
                      MataHati uses advanced location-based technology to instantly connect visually impaired individuals with nearby volunteers, ensuring quick and reliable assistance whenever needed.
                    </p>
                    <div class="feature-points">
                      <div class="point">
                        <i class="fas fa-location-dot"></i>
                        <span>Smart Location Matching</span>
                      </div>
                      <div class="point">
                        <i class="fas fa-clock"></i>
                        <span>Quick Response Time</span>
                      </div>
                      <div class="point">
                        <i class="fas fa-users"></i>
                        <span>Verified Volunteers</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-image">
                    <img src="./assets/img/volunteer-connect.png" alt="Volunteer Connection Feature" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Service Cards -->
          <div class="col-lg-4 col-md-6" data-aos="fade-down" data-aos-delay="200">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="fas fa-phone-alt"></i>
              </div>
              <h4>Easy Phone Calls</h4>
              <p>Simple one-touch calling system to connect with volunteers. Voice-guided interface for easy navigation.</p>
              <ul class="service-features">
                <li><i class="fas fa-check"></i> Voice-activated controls</li>
                <li><i class="fas fa-check"></i> Emergency quick-dial</li>
                <li><i class="fas fa-check"></i> Audio feedback</li>
              </ul>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-down" data-aos-delay="400">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <h4>Smart Matching</h4>
              <p>Intelligently matches users with the nearest available volunteers based on location and specific needs.</p>
              <ul class="service-features">
                <li><i class="fas fa-check"></i> Location-based matching</li>
                <li><i class="fas fa-check"></i> Skill-based allocation</li>
                <li><i class="fas fa-check"></i> Real-time availability</li>
              </ul>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-down" data-aos-delay="600">
            <div class="service-card">
              <div class="icon-wrapper">
                <i class="fas fa-shield-alt"></i>
              </div>
              <h4>Safe & Secure</h4>
              <p>Comprehensive safety measures ensuring all volunteers are verified and trustworthy.</p>
              <ul class="service-features">
                <li><i class="fas fa-check"></i> Background checks</li>
                <li><i class="fas fa-check"></i> Rating system</li>
                <li><i class="fas fa-check"></i> Safety protocols</li>
              </ul>
            </div>
          </div>
        </div>
      </div>


      <!-- Call to Action -->
      <div class="cta-box text-center mt-5">
        <h3>Ready to Experience MataHati?</h3>
        <p>Join our community and make a difference in someone's life today</p>
        <div class="cta-buttons">
          <a href="#" class="btn primary me-3">Become a Volunteer</a>
          <a href="#" class="btn btn-outline-success">Need Assistance?</a>
        </div>
      </div>
  </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    AOS.init();

    $(window).on('load', function() {
      $(".preloader").fadeOut("1500");
    });
  </script>
</body>

</html>