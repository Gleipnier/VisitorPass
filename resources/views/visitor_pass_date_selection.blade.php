<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Visit Date</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.75rem;
            color: #343a40;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        label {
            font-weight: 500;
        }

        button {
            margin-top: 1.5rem;
        }

        /* Make QR Code container responsive */
        #qrCodeContainer {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        .qr-code {
            width: 100%;
            max-width: 300px;
            height: auto;
        }

        /* Media queries for smaller screens */
        @media (max-width: 575.98px) {
            .container {
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Select Visit Date</h1>

        <div class="mb-3">
            <label for="visit_date" class="form-label">Visit Date:</label>
            <input type="date" id="visit_date" v-model="visitDate" :min="today" class="form-control">
        </div>

        <button @click="generatePass" class="btn btn-primary w-100">Generate Pass</button>

        <!-- Message Section -->
        <div v-if="message" :class="['alert mt-4', message.success ? 'alert-success' : 'alert-danger']" role="alert">
            @{{ message.text }}
        </div>

        <!-- QR Code Display -->
        <div id="qrCodeContainer" v-if="qrCode">
            <h2 class="text-center mt-4">Your QR Code:</h2>
            <div v-html="qrCode" class="qr-code"></div>
        </div>
        
        <button id="download-pdf" class="btn btn-secondary w-100" style="display: none; margin-top: 10px;">Download PDF
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '.container',
            data: {
                visitDate: '',
                message: null,
                qrCode: null,
                today: new Date().toISOString().split('T')[0],
            },
            methods: {
                generatePass() {
                    axios.post('/generate-visitors-pass', {
                        visit_date: this.visitDate
                    })
                    .then(response => {
                        if (response.data.success) {
                            this.qrCode = response.data.qrCode;
                            this.message = { success: true, text: 'Pass generated successfully!' };
                            document.getElementById('download-pdf').style.display = 'block';
                        } else {
                            this.message = { success: false, text: response.data.message };
                        }
                    })
                    .catch(error => {
                        this.message = { success: false, text: error.response.data.message || 'An error occurred.' };
                    });
                }
            }
        });
        document.getElementById('download-pdf').addEventListener('click', function() {
            const visitDate = document.getElementById('visit_date').value;
            window.location.href = `/download-visitor-pass?visit_date=${visitDate}`;
        });
    </script>
</body>

</html>
