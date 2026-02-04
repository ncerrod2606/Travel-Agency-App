@extends('app.bootstrap.template')

@section('content')
<!-- Hero Section -->
<div class="row align-items-center mb-5">
    <div class="col-lg-6">
        <h1 class="display-4 fw-bold mb-4">About Wayfarer</h1>
        <p class="lead text-muted mb-4">
            We are more than just a travel agency; we are your gateway to the extraordinary. At Wayfarer, we believe that travel is the only thing you buy that makes you richer.
        </p>
        <p>
            Founded in 2024, Wayfarer was born from a passion for exploration and a commitment to excellence. We curate bespoke travel experiences that transcend the ordinary, connecting you with the heart and soul of every destination. Whether you seek the tranquility of secluded beaches or the vibrancy of bustling metropolises, we handle every detail so you can focus on the journey.
        </p>
    </div>
    <div class="col-lg-6">
        <div class="rounded-3 shadow-sm overflow-hidden" style="height: 400px;">
            <img src="{{ asset('assets/img/hero_banner.jpg') }}" class="w-100 h-100 object-fit-cover" alt="Travel Experiences">
        </div>
    </div>
</div>

<!-- Our Story Section -->
<div class="row mb-5 align-items-center">
    <div class="col-lg-12">
        <div class="bg-white p-5 rounded-4 shadow-sm border">
            <h2 class="fw-bold mb-4 text-center">Our Story</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center text-muted">
                    <p class="mb-4">
                        It all started with a backpack and a dream. Our founders, avid travelers themselves, realized that the modern travel industry lacked a personal touch. They wanted to create a service that didn't just book flights and hotels, but crafted narratives. 
                    </p>
                    <p class="mb-4">
                        From a small home office to a global network of local experts, Wayfarer has grown nicely, but our core mission remains the same: to inspire and enable people to explore the world with open eyes and open hearts. We have visited over 100 countries combined, testing every hotel, tour, and restaurant to ensure our clients experience only the best.
                    </p>
                    <p>
                        Today, we are proud to be a leading boutique agency, recognized for our attention to detail and our ability to turn complex itineraries into seamless adventures.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sustainability Section -->
<div class="row mb-5 align-items-center">
    <div class="col-lg-6 order-lg-2">
         <h2 class="fw-bold mb-4">Travel with a Conscience</h2>
         <p class="text-muted mb-4">
             We believe in responsible travel. That's why we partner with eco-friendly resorts, support local communities, and offset our carbon footprint for every trip booked. 
         </p>
         <ul class="list-unstyled text-muted">
             <li class="mb-2"><i class="fas fa-leaf text-success me-2"></i> Carbon neutral operations</li>
             <li class="mb-2"><i class="fas fa-hand-holding-heart text-success me-2"></i> Supporting local artisans</li>
             <li class="mb-2"><i class="fas fa-globe-americas text-success me-2"></i> Conservation initiatives</li>
         </ul>
    </div>
    <div class="col-lg-6 order-lg-1">
        <div class="p-5 bg-light rounded-4 text-center">
             <i class="fas fa-tree text-success" style="font-size: 5rem;"></i>
             <h4 class="mt-4 fw-bold">Sustainability First</h4>
        </div>
    </div>
</div>

<!-- Why Choose Us Cards -->
<div class="row mb-5">
    <div class="col-12 text-center mb-5">
        <h2 class="fw-bold">Why Choose Us</h2>
        <p class="text-muted">Experience the difference with our premium services</p>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
            <div class="card-body text-center p-4">
                <div class="mb-3 text-primary">
                    <i class="fas fa-map-marked-alt fa-2x"></i>
                </div>
                <h5 class="card-title fw-bold mb-3">Curated Destinations</h5>
                <p class="card-text text-muted">Hand-picked locations ensuring you experience the very best each country has to offer, away from the tourist traps.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
            <div class="card-body text-center p-4">
                <div class="mb-3 text-primary">
                   <i class="fas fa-headset fa-2x"></i>
                </div>
                <h5 class="card-title fw-bold mb-3">24/7 Global Support</h5>
                <p class="card-text text-muted">Our dedicated team is always just a call away, providing you with peace of mind no matter where you are in the world.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
            <div class="card-body text-center p-4">
                <div class="mb-3 text-primary">
                    <i class="fas fa-tags fa-2x"></i>
                </div>
                <h5 class="card-title fw-bold mb-3">Best Price Guarantee</h5>
                <p class="card-text text-muted">We work directly with local partners to ensure you get the most value for your money without compromising on quality.</p>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="row mb-5">
    <div class="col-12 text-center mb-5">
        <h2 class="fw-bold">Frequently Asked Questions</h2>
        <p class="text-muted">Everything you need to know about booking with Wayfarer</p>
    </div>
    <div class="col-lg-8 mx-auto">
        <div class="accordion accordion-flush" id="faqAccordion">
            <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed fw-bold px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        How do I book a custom itinerary?
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body px-4 pb-4 text-muted">
                        Simply contact our support team or use the "Custom Trip" form on our packages page. One of our travel specialists will reach out to you within 24 hours to schedule a consultation and start planning your dream journey.
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed fw-bold px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        What is included in the package price?
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body px-4 pb-4 text-muted">
                        Our packages typically include accommodations, daily breakfast, airport transfers, and guided tours as listed in the itinerary. International flights are usually quoted separately to give you the flexibility to use miles or choose your preferred airline.
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed fw-bold px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Do you offer travel insurance?
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body px-4 pb-4 text-muted">
                        Yes, we strongly recommend travel insurance. We partner with top-tier insurance providers to offer comprehensive coverage for trip cancellations, medical emergencies, and lost luggage. You can add this during the booking process.
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button collapsed fw-bold px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        What is your cancellation policy?
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body px-4 pb-4 text-muted">
                        We understand that plans change. Our standard policy allows full refunds up to 30 days before departure, and partial refunds up to 14 days before. Specific terms may vary depending on the destination and accommodation providers.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection