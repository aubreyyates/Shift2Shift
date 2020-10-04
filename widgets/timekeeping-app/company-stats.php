<link href="css/timekeeping-app/company-stats.css" rel="stylesheet">

<div>
    <div class='space20'></div>
    <div class='space20'></div>
    <div id='data-area'>
        <div class='data-box-1'>
            <div class='timekeeping-app-company-stats-timestamp-data'>
                <p class='timekeeping-app-company-stats-text font-1' id='timekeeping-app-company-stats-total-timestamp-length-text'>
                    Total time clocked:
                </p>
                <p class='timekeeping-app-company-stats-data font-1' id='timekeeping-app-company-stats-total-timestamp-length'>

                </p>
            </div>
            <div class='timekeeping-app-company-stats-break-data'>
                <p class='timekeeping-app-company-stats-text font-1' id='timekeeping-app-company-stats-total-break-length-text'>
                    Total break time:
                </p>
                <p class='timekeeping-app-company-stats-data font-1' id='timekeeping-app-company-stats-total-break-length'>
                    
                </p>
            </div>
            <div class='timekeeping-app-company-stats-timestamp-data'>
                <div class='timekeeping-app-company-stats-text'>
                    <p class='font-1' id='timekeeping-app-company-stats-number-of-timestamps-text'>
                        Total timestamps:
                    </p>
                </div>
                <div class='timekeeping-app-company-stats-data'>
                    <p class='font-1' id='timekeeping-app-company-stats-number-of-timestamps'>

                    </p>
                </div>
            </div>
            <div class='timekeeping-app-company-stats-break-data'>
                <div class='timekeeping-app-company-stats-text'>
                    <p class='font-1' id='timekeeping-app-company-stats-number-of-breaks-text'>
                        Total breaks:
                    </p>
                </div>
                <div class='timekeeping-app-company-stats-data'>
                    <p class='font-1' id='timekeeping-app-company-stats-number-of-breaks'>
                        
                    </p>
                </div>
            </div>
        </div>
        <div class='data-box-2 font-1'>
            <div class='timekeeping-app-company-stats-heading'>Clock time to break time percentages</div>
            <div class='timekeeping-app-company-stats-color-key'>
                <div class='timekeeping-app-company-stats-color-key-container'>
                    <div class='timekeeping-app-company-stats-color-1 timekeeping-app-company-stats-color-box'>
                    </div>
                    <p>Clocked Time</p>
                </div>
                <div class='timekeeping-app-company-stats-color-key-container'>
                    <div class='timekeeping-app-company-stats-color-2 timekeeping-app-company-stats-color-box'>
                    </div>
                    <p>Break Time</p>
                </div>
            </div>
            <div class='timekeeping-app-company-stats-timestamps-to-breaks-chart'>
                <div id='timekeeping-app-company-stats-timestamps-to-breaks-timestamp-section' class='bar-chart'>
                    <p id='timekeeping-app-company-stats-timestamps-to-breaks-timestamp-section-text'></p>
                </div>
                <div id='timekeeping-app-company-stats-timestamps-to-breaks-break-section' class='bar-chart'>
                    <p id='timekeeping-app-company-stats-timestamps-to-breaks-break-section-text'></p>
                </div>
                <div id='timekeeping-app-company-stats-timestamps-to-breaks-no-data' class='bar-chart-no-data'>
                    <p>No Data</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='js/timekeeping-app/company-stats.js'></script>