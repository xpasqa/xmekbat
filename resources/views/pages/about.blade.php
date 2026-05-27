    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ URL::asset('/dist/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ URL::asset('/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ URL::asset('/dist/css/style.css') }}" rel="stylesheet">
@extends('templates.header')



<body class="fill-white">
    <!-- body  -->

    @extends('templates.navbar')
    @section('content')

    
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 bg-about mb-5">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-12 text-center">
                    <h1 class="display-1 text-white mb-md-4">About</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Content Start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h5 class="title">HISTORY</h5>
                <p>
                <br>In 1996, Prof. Irwandy Arif, the head of the Department of Mining Engineering ITB, tasked Dr. Suseno Kramadibrata with establishing a practical laboratory for students. At that time, the laboratory facilities were severely lacking in equipment. Therefore, the courses were conducted modestly. The initial development phase entailed laboratory enhancement, followed by acquiring instrumentation and equipment by designing and locating used equipment at various mine sites in Indonesia.
                <br>
                <br>In 1997, Prof. Made Astawa Rai, the manager of the Rock Mechanics Laboratory (former name of the Laboratory of Geomechanics and Mine Equipment), requested that Dr. Suseno Kramadibrata make specific repairs and improvements to laboratory facilities so that both students and lecturers could conduct various Geomechanics research. The Rock Mechanics Laboratory aids with the following courses: Rock Mechanics, Drilling and Excavation, Blasting Technique, Mine Equipment, Mine Ventilation, Underground Mine Support, Monitoring System, and Mine Surveying.
                <br><br>On March 28, 2007, Dr. Suseno Kramadibrata was appointed manager of the Laboratory of Geomechanics and Mine Equipment, which is divided into four departments:
                <br>1. Rock Mechanics Working Group, led by Dr. Ridho Kresna Wattimena
                <br>2. Mine Explosives and Blasting Technique Working Group, led by Dr. Ganda Marihot Simangunsong
                <br>3. Drilling and Excavation Technique Working Group, led by Dr. Nuhindro Priagung Widodo
                <br>4. Surface and Underground Mine Equipment Working Group, led by Dr. Budi Sulistianto
                <br>
                <br>On June 11, 2013, the Laboratory of Geomechanics and Mine Equipment received official certification from the Ministry of Research of the Indonesian Republic. Certification was obtained in accordance with the Decree of the Head of the National Standard Accreditation Department No 1976/KAN-HK.37/07/2000 regarding establishing the Indonesian National Standard 19-17025-2000 as laboratory accreditation requirements.
                </p>
            </div>
            <div class="col-lg-8 mt-5">
                <h5 class="title">VISION, MISSION & OBJECTIVES</h5>
                <p>
                <br>The entire Laboratory of Geomechanics and Mine Equipment staff is dedicated to delivering services of the highest quality to the public in accordance with the laboratory's quality policy.
                <br><br>The following commitments are stated in the quality policy:
                <br>
                <li>Provide professional testing services to satisfy customer needs and follow quality standards;</li>
                <li>The entire laboratory staff understands and consistently implements the laboratory management system following ISO/IEC 17025:2017;</li>
                <li>Enhance the efficiency of the laboratory management system sustainably.</li>
                <br>To meet our commitments, we will:
                <br>
                <li>Continually establish and maintain an Occupational Safety and Health Management System (OSHMS) with the necessary resources;</li>
                <li>Ensure that the workplace and the task are compliant with government OSH laws, regulations, and other requirements;</li>
                <li>Provide OSH training, education, and awareness to all employees to enhance the laboratory's OSH performance.</li>
                </p>
            </div>
            <!-- Team  -->
            <div class="col-lg-8 my-5">
                <h5 class="title">TEAM</h5>
                <div class="row my-3">
                    @foreach ($people as $row)
                        <div class="col-2 col-md-4 mt-5 text-center clickclass" id="{{$row->id_people}}" slug="{{$row->slug}}">
                            <img src="{{url('storage/people/'.$row->image.'')}}" class="img-fluid rounded-circle circleteam">
                            <p class="title mb-0 mt-3">{{$row->name}}</p>
                            <p>{{$row->position}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- end team  -->
        </div>
    </div>
    <!-- Content End -->
    

        <!-- Footer Start -->
        @extends('templates.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>

</body>

</html>
    <!-- script  -->
    <script src="{{ URL::asset('/dist/js/custom.js') }}"></script>
    <!-- news  -->
    <script>
        var list = document.querySelectorAll("div[data-image]");
        for (var i = 0; i < list.length; i++) {
        var url = list[i].getAttribute('data-image');
        list[i].style.backgroundImage="url('" + url + "')";
        }
    </script>
    <!-- *---* -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('/dist/lib/easing/easing.min.js') }}"></script>
    <script src="{{ URL::asset('/dist/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('/dist/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ URL::asset('/dist/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ URL::asset('/dist/js/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.clickclass').click(function(){
                var slug = $(this).attr('slug');
                var url = '{{ route("people.peopleDetail", ":slug") }}';
                url = url.replace(':slug', slug);

                window.location.replace(url);
            });
        });
    </script>
@endsection
@extends('templates.globalscript')
