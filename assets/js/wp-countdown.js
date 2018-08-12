/*
    wp-countdown.js

    Expects DIV tag with the following data attributes;
    if data-expiry-date is not set then this function is disabled (essentially allows two countdowns in one)

    <div class='wp-countdown'
         data-pending-due-text='Countdown until the start of Notting Hill Carnival'
         data-pending-expiry-text='Countdown until the end of Notting Hill Carnival'
         data-expired-text='Carnival has finished!'
         data-due-date='2018-08-25T06:00'
         data-expiry-date='2018-08-26T21:00'>
    </div>
*/

window.countdown = window.countdown || {};

window.countdown.UI = (function (jQuery) {
    var countdownContainer;
    var targetDate;

    Instance = (function () {
        function getDateFromElement(element, dataAttributeName) {
            var dateTimeParts = element.data(dataAttributeName).split('T');
            var dateParts = dateTimeParts[0].split('-');
            var timeParts = dateTimeParts[1].split(':');
            return new Date(
                parseInt(dateParts[0]),
                parseInt(dateParts[1]) - 1,
                parseInt(dateParts[2]) - 1,
                parseInt(timeParts[0]),
                parseInt(timeParts[1]))
                .getTime();
        }
      
        function getTimeStringFromDistance(distance) {
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
            return timeString;
        }
      
        function initContainer(element) {
            // Extract countdown date from data attribute
            var dueDate = getDateFromElement(element, 'dueDate');
            var expiryDate = getDateFromElement(element, 'expiryDate');

            // Update the count down every 1 second
            var timer = setInterval(function() {
                // Get todays date and time
                var now = new Date().getTime();
                
                var prefixString = '';
                var timeString = '';
                if (dueDate > now) {
                    prefixString = element.data('pendingDueText');
                    timeString = getTimeStringFromDistance(dueDate - now);
                }
                else if (expiryDate > now) {
                    prefixString = element.data('pendingExpiryText');
                    timeString = getTimeStringFromDistance(expiryDate - now);
                }
                else {
                    prefixString = element.data('expiryText');
                    clearInterval(timer);
                }

                // Display the result
                element.html('<span class=\'prefix\'>' + prefixString + '</span><span class=\'time\'>' + timeString + '</span');
            }, 1000);
        }
        
        return {
            init: initContainer
        };
    });

    function initCountdown() {
        $('.wp-countdown').each(
            function (index, element) {
                var instance = new Instance();
                instance.init($(element));
            });
    }

    return {
        init: initCountdown
    };
})($);

window.countdown.UI.init();
