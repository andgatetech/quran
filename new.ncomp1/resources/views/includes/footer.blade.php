<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<style>
    @font-face {
    font-weight: normal;
    font-style: normal;
        font-family: sans-serif;

}

*{
    padding: 0;margin: 0;
    box-sizing: border-box !important;
}
html, body {
    height: 100%; /* Ensure html and body take the full height */
    margin: 0;
    display: flex;
    flex-direction: column; /* Arrange elements vertically */
    font-family:  sans-serif;

}

body {

    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    flex-grow: 1;
    padding:0 .5rem 1rem .5rem !important;
    /* padding-bottom: 1rem !important; */
}


.footer {
    display: flex;
    align-items: center;
    justify-content: center; /* Center footer content */
    padding: 10px 20px;
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 90%; /* Footer spans full width */
    position: relative; /* Relative to the parent */
    text-align: center;
    margin-top: 3rem; /* Push footer to the bottom */
    margin-bottom: 2rem !important; /* Push footer to the bottom */

}


  .container {
      /* flex-grow: 1; */
      width: 100%;
      text-align: center;
      margin: 0 auto;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 0 1rem;
      /* margin-bottom: ; */

    }

    .form-container {
      background-color: var(--primary-color);
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 30px;
      box-shadow: none !important;
padding-bottom: 0 !important;
    }

        /* Footer Container */


        /* Logo Styling */
        .footer img {
            height: 50px;
            flex-shrink: 0;
            margin-right: 10px;
        }

        /* Text Styling */
        .footer-text {
            font-size: .8rem;
            color: #00a497;
            font-weight: 600;
            text-align: left;
            text-align: center;
width: 100%;
            word-wrap: break-word;
        }

        @media (max-width: 600px) {
            .footer {
                flex-direction: row;
                align-items: center;
                padding: 10px;
            }

            .footer-text {
                font-size: 0.9rem; /* Slightly smaller for mobile */
                line-height: 1.3;
            }
        }













/*
         body {
position:relative;

    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 60vw;
    padding: 10px;
  }
 */



  .button-group1 a{color: var(--secondary-color) ;
    border:1px solid var(--secondary-color) ;
    }


.active-button{    background-color: var(--secondary-color) !important;
    color: #ffffff !important;

}
.button-group1 a:hover{background-color: var(--secondary-color) !important;
    color: #ffffff !important;}

  .btn-save {
    background-color: var(--secondary-color) !important;
    color: #ffffff !important;
    border-radius: 10px;
    padding: 10px 20px;
    font-size: 16px;
    transition: background-color 0.3s;
    width: 100% !important;
    border-radius: .5rem !important;
}


            /* Header */
    .header {
      display: flex;
      align-items: center;
      background-color: var(--secondary-color);;
      color: var(--primary-color);
      padding: 15px 20px;
      border-radius:0 0  1rem 1rem;
      margin-bottom: 20px;
      width: 100%; /* Ensure the header spans the full width */
      box-sizing: border-box; /* Ensure padding doesn't affect the width calculation */
    }

    .header h1 {
      flex-grow: 1;
      font-size: 18px;
      text-align: center;
    }

    .back-btn {
      background: none;
      border: none;
      color: var(--primary-color);
      font-size: 18px;
      cursor: pointer;
    }




    /* .container1{ flex-grow: 1;  width: 100%;  } */



    .tabs {
      display: flex;
      justify-content: space-around;
      margin-bottom: 20px;
      display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content:center !important;
        gap: 1rem;

    }

    .tab-btn {
      font-size: 14px;
      padding: .4rem 1rem;
      border-radius: 20px;
      border: 2px solid var(--secondary-color);;
      background-color: var(--primary-color);
      color: var(--secondary-color);;
      cursor: pointer;
      transition: all 0.3s;



    }

    .tab-btn.active {
      background-color: var(--secondary-color);;
      color: var(--primary-color);


    }

    .tab-btn:hover {
      background-color: var(--secondary-color);;
      color: var(--primary-color);
    }
    .card-buttons {
      margin-top: 10px;
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
    }

    .active-btn {
      background-color: var(--secondary-color);
      color: var(--primary-color);
      border: 1px solid var(--secondary-color);
    }
    /* .btn {
      font-size: .9rem !important;
      border-radius: .3rem !important;
      padding: .4rem 0 !important;
      border: 1px solid var(--secondary-color) !important;
      background-color: var(--secondary-color) !important;
      color: var(--primary-color) !important;
      cursor: pointer !important;
      text-align: center !important;
      margin: 5px !important;
    } */

    .delete-btn {
      background-color: #e74c3c !important;
      color: var(--primary-color) !important;
      border: none !important;
      border-radius: .3rem;
      min-width: 5rem !important;
    }

    .edit-btn {
      background-color: var(--secondary-color)  !important;
      color: var(--primary-color) !important;
      border: none !important;
      border-radius: .3rem;
      min-width: 5rem !important;
    }

    .content{margin-top: 0 !important;}

    #success-alert{
        position: absolute;
        right: 60px;
        top: 60px
    }

</style>
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="btn-close mt-2" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<script>
    // Automatically close the alert after 5 seconds (5000 milliseconds)
    setTimeout(() => {
        const alertElement = document.getElementById('success-alert');
        if (alertElement) {
            alertElement.classList.remove('show'); // Start fading out
            alertElement.classList.add('fade'); // Optional: If you want the fade effect
            setTimeout(() => alertElement.remove(), 200); // Remove from DOM after fading
        }
    }, 5000);
</script>

<div class="footer">
    <img src="{{ asset('public/assets/img/logo.png') }}" alt="Logo">
    <div class="footer-text">
      C o py r i g h t 2 0 2 5
      © The Garden of Quran<br>
        
    </div>
</div>
