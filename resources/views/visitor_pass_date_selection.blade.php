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

        .btn-primary {
            background-color: hsl(150, 7.69%, 94.9%);
            color: #374151;
        }
        .btn-primary:hover {
            background-color: #facc15;
        }
        .container {
            max-width: 500px;
            background: #8268d1;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.75rem;
            color: #f8f9fa;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        label {
            font-weight: 500;
            color: #fff;
        }

        button {
            margin-top: 1.5rem;
        }

        .qr-code {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .qr-code svg {
            max-width: 100%;
            height: auto;
        }
        .history-table {
            margin-top: 30px;
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
    
    <div class="container" id="app">
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
            <h2 class="text-center mt-4">Your Visitor Pass</h2>
            <div v-html="qrCode" class="qr-code"></div>
        </div>
       
        <button id="download-pdf" @click="downloadPdf" class="btn btn-secondary w-100" v-if="qrCode" style="margin-top: 10px;">Download PDF</button>
        <button id="go-home" @click="goHome" class="btn btn-secondary w-100" style="margin-top: 10px;">GO HOME</button>
       
        <!-- History Section -->
        <div class="history-table" v-if="history.length > 0">
            <h3 style="color: #fff">Previous Passes</h3>
            <table class="table table-striped">
                <thead style="color: white;">
                    <tr>
                        <th>Visit Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="pass in history" :key="pass.id">
                        <td style="color: #fff">@{{ pass.formattedDate }}</td>
                        <td>
                            <button @click="downloadPdf(pass.visit_date)" class="btn btn-sm btn-info">Download</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                visitDate: '',
                message: null,
                qrCode: null,
                today: new Date().toISOString().split('T')[0],
                history: []
            },
            mounted() {
                this.fetchHistory();
            },
            methods: {
                
                generatePass() {
                    console.log('Generating pass with date:', this.visitDate);
                    axios.post('/generate-visitors-pass', {
                        visit_date: this.visitDate
                    })
                    .then(response => {
                        console.log('Response:', response.data); 
                        if (response.data.success) {
                            this.qrCode = response.data.qrCode;
                            this.message = { success: true, text: 'Pass generated successfully!' };
                            this.fetchHistory(); // Refresh history after generating new pass
                        } else {
                            this.message = { success: false, text: response.data.message };
                        }
                    })
                    .catch(error => {
                        this.message = { success: false, text: error.response.data.message || 'An error occurred.' };
                    });
                },
                downloadPdf(date = this.visitDate) {
                    if (typeof date === 'object') {
                        // Avoid passing an event object
                        date = this.visitDate;
                    }
                    window.location.href = `/download-visitor-pass?visit_date=${date}`;
                },
                goHome() {
                    window.location.href = '/home';
                },
                
                fetchHistory() {
                    axios.get('/visitor-pass-history')
                    .then(response => {
                        this.history = response.data
                        .map(pass => {
                            return {
                                ...pass,
                                formattedDate: new Date(pass.visit_date).toLocaleDateString() // Format the date
                            };
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching history:', error);
                    });
                }
                
            }
        });
    </script>
</body>

</html>
