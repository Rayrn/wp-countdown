window.countdown = window.countdown || {};

window.countdown.UI = (function (jQuery) {
    Instance = (function () {
        function initContainer(element) {
            // Extract countdown date from data attribute
            var dateTimeParts = element.data('date').split('T');
            var dateParts = dateTimeParts[0].split('-');
            var timeParts = dateTimeParts[1].split(':');
            var countdownDate = new Date(
                parseInt(dateParts[0]),
                parseInt(dateParts[1]) - 1,
                parseInt(dateParts[2]) - 1,
                parseInt(timeParts[0]),
                parseInt(timeParts[1]))
                .getTime();

            // Update the count down every 1 second
            var timer = setInterval(function() {
                // Get todays date and time
                var now = new Date().getTime();
                
                // Find the distance between now and the count down date
                var distance = countdownDate - now;
                
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                var timeString = '';
                if (days > 0) {
                    timeString += days + 'd ';
                }
                if (days > 0 || hours > 0) {
                    timeString += hours + 'h ';
                }
                if (days > 0 || hours > 0 || minutes > 0) {
                    timeString += minutes + 'm ';
                }
                if (days > 0 || hours > 0 || minutes > 0 || seconds > 0) {
                    timeString += seconds + 's';
                }

                // Display the result
                element.html('<span class=\'active\'>' + timeString + '</span');
                
                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(timer);
                    element.html('<span class=\'expired\'>Is here!</span>');
                }
            }, 1000);
        }
        
        return {
            init: initContainer
        };
    });

    function initCountdown() {
        jQuery('.wp-countdown').each(
            function (index, element) {
                var instance = new Instance();
                instance.init(jQuery(element));
            });
    }

    return {
        init: initCountdown
    };
})(jQuery);

window.countdown.UI.init();
