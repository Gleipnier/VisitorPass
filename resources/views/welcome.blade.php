@extends('layouts.homeapp')

@section('title', 'Home')
<style>
body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    height: 100%;
}

body {
    /* background-image: url('admincss/img/nature.jpg'); */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background: white;
}

.content {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.header {
    display: flex;
    align-items: center;
    background-color: rgba(51, 51, 51, 0.8);
    color: black;
    padding: 20px;
}

.header-text {
    flex: 1;
}

.title {
    font-size: 24px;
    font-weight: bold;
}

.subtitle {
    font-size: 18px;
}

.header-image {
    flex: 1;
    text-align: right;
}

.header-image img {
    border-radius: 50%;
    max-width: 100%; /* Ensures the image is responsive */
    height: auto; /* Maintains aspect ratio */
    width: 850px; /* You can adjust this for the default size on larger screens */
}

.description {
    margin-top: 20px;
    font-size: 16px;
    color: black;
}

.action-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.action-buttons button {
    background-color: transparent;
    border: 1px solid white;
    color: black;
    padding: 10px 20px;
    cursor: pointer;
}

.signup {
    margin-top: 20px;
}

.signup button {
    background-color: #e50914;
    color: white;
    border: none;
    padding: 15px 30px;
    font-size: 18px;
    cursor: pointer;
    width: 100%;
}

.pricing {
    margin-top: 20px;
    font-size: 14px;
    text-align: center;
    color: white;
}

/* Ensure layout doesn't change on smaller screens */
@media (max-width: 600px) {
    .content {
        padding: 10px;
    }

    .header, .action-buttons {
        flex-direction: column;
    }

    .header-image {
        margin-top: 20px;
        text-align: center;
    }

    .header-image img {
        width: 100px; /* Shrink image size on mobile */
        max-width: 100%; /* Ensure responsiveness */
        height: auto; /* Maintain aspect ratio */
    }
    .action-buttons button {
        margin-bottom: 10px;
    }
}

</style>
@section('content')

        <body>
                <div class="content">
                    <div class="header">
                        <div class="header-text">
                            <div class="title">Visitor Pass</div>
                            <div class="subtitle">Please Register to Access All Features</div>
                        </div>
                        {{-- <div class="header-image">
                            <img src="images/bodolandlogo3.png" alt="BTC Logo">
                        </div> --}}
                    </div>
                    
                    <div class="description">
                        <p>Aaron Sorkin teaches you the craft of film and television screenwriting.</p>
                    </div>
                    
                    <div class="action-buttons">
                        <button>Trailer</button>
                        <button>Sample</button>
                        <button>Share</button>
                    </div>
                    
                    <div class="signup">
                        <button>Sign Up</button>
                    </div>
                    
                    <div class="pricing">
                        Starting at $15/month (billed annually) for all classes and sessions
                    </div>
                </div>
            </body>


   
@endsection