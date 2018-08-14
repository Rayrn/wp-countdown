/*
    wp-countdown.ts

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

import '../css/wp-countdown.css';

class Countdown {
    constructor(doc: Document) {
        const elements = doc.querySelectorAll('.wp-countdown');
        elements.forEach(
            (element: Element) => {
                this.initContainer(element as HTMLDivElement);
            });
    }

    private initContainer(element: HTMLDivElement): void {
        // Extract countdown date from data attribute
        const dueDate = this.getDateFromElement(element, 'dueDate');
        const expiryDate = this.getDateFromElement(element, 'expiryDate');

        // Update the count down every 1 second
        const timer = setInterval(() => {
            // Get todays date and time
            const now = new Date().getTime();

            let prefixString: string | undefined = '';
            let timeString = '';
            if (dueDate !== null && dueDate > now) {
                prefixString = element.dataset.pendingDueText;
                timeString = this.getTimeStringFromDistance(dueDate - now);
            }
            else if (expiryDate !== null && expiryDate > now) {
                prefixString = element.dataset.pendingExpiryText;
                timeString = this.getTimeStringFromDistance(expiryDate - now);
            }
            else {
                prefixString = element.dataset.expiryText;
                clearInterval(timer);
            }

            // Display the result
            element.innerHTML =
                `<span class=\'prefix\'>${prefixString}</span><span class=\'time odometer\'>${timeString}</span`;
        }, 1000);
    }

    private getDateFromElement(element: HTMLDivElement, dateAttributeName: string): number | null {

        const dateBlob = element.dataset[dateAttributeName];
        if (typeof dateBlob === 'undefined') {
            return null;
        }

        const dateTimeParts = dateBlob.split('T');
        const dateParts = dateTimeParts[0].split('-');
        const timeParts = dateTimeParts[1].split(':');
        
        return new Date(
            parseInt(dateParts[0], 10),
            parseInt(dateParts[1], 10) - 1,
            parseInt(dateParts[2], 10) - 1,
            parseInt(timeParts[0], 10),
            parseInt(timeParts[1], 10))
            .getTime();
    }
  
    private getTimeStringFromDistance(distance: number): string {
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        let timeString = '';
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
}

((doc: Document) => {
    return new Countdown(doc);
})(document);
