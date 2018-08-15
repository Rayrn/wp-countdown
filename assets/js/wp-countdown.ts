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
      <span class='wp-countdown-prefix-label'></span
      <div class='wp-countdown-countdown'>
        <div class='wp-countdown-days'>
          <span class="odometer countdown-time-days"></span>
          <span class="countdown-time-days-label">d</span>
        </div>
        <div class='wp-countdown-hours'>
          <span class="odometer countdown-time-hours"></span>
          <span class="countdown-time-hours-label">h</span>
        </div>
        <div class='wp-countdown-minutes'>
          <span class="odometer countdown-time-minutes"></span>
          <span class="countdown-time-minutes-label">m</span>
        </div>
        <div class='wp-countdown-seconds'>
          <span class="odometer countdown-time-seconds"></span>
          <span class="countdown-time-seconds-label">s</span>
        </div>
      </div>
    </div>
*/

import '../css/wp-countdown.css';

interface IUpdateElementOptions {
    element: HTMLDivElement;
    value: number;
    containerClass: string;
    labelClass: string;
}

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

            if (dueDate !== null && dueDate > now) {
                this.updatePrefixLabel(element, element.dataset.pendingDueText);
                this.updateTimeFromDistance(element, dueDate - now);
            }
            else if (expiryDate !== null && expiryDate > now) {
                this.updatePrefixLabel(element, element.dataset.pendingExpiryText);
                this.updateTimeFromDistance(element, expiryDate - now);
            }
            else {
                this.updatePrefixLabel(element, element.dataset.expiredText);
                clearInterval(timer);
            }
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
  
    private updatePrefixLabel(element: HTMLDivElement, label: string | undefined): void {
        if (typeof label === 'undefined') {
            label = 'missing text';
        }

        const labelElement = element.getElementsByClassName('wp-countdown-prefix-label')[0] as HTMLSpanElement;
        labelElement.innerText = label;
    }

    private updateTimeFromDistance(element: HTMLDivElement, distance: number): void {
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if (days > 0) {
            this.updateTimeElementWhenVisible({
                element,
                value: days,
                containerClass: 'wp-countdown-days',
                labelClass: 'countdown-time-days'
            });
        }
        else {
            this.updateTimeElementWhenNotVisible(element, 'wp-countdown-days');
        }

        if (days > 0 || hours > 0) {
            this.updateTimeElementWhenVisible({
                element,
                value: hours,
                containerClass: 'wp-countdown-hours',
                labelClass: 'countdown-time-hours'
            });
        }
        else {
            this.updateTimeElementWhenNotVisible(element, 'wp-countdown-hours');
        }

        if (days > 0 || hours > 0 || minutes > 0) {
            this.updateTimeElementWhenVisible({
                element,
                value: minutes,
                containerClass: 'wp-countdown-minutes',
                labelClass: 'countdown-time-minutes'
            });
        }
        else {
            this.updateTimeElementWhenNotVisible(element, 'wp-countdown-minutes');
        }

        if (days > 0 || hours > 0 || minutes > 0 || seconds > 0) {
            this.updateTimeElementWhenVisible({
                element,
                value: seconds,
                containerClass: 'wp-countdown-seconds',
                labelClass: 'countdown-time-seconds'
            });
        }
        else {
            this.updateTimeElementWhenNotVisible(element, 'wp-countdown-seconds');
        }
    }

    private updateTimeElementWhenVisible(
        options: IUpdateElementOptions): void {
        const container = options.element.getElementsByClassName(options.containerClass)[0] as HTMLDivElement;
        const labelElement = container.getElementsByClassName(options.labelClass)[0] as HTMLSpanElement;
        labelElement.innerText = options.value.toString();
        container.style.display = 'inline';
    }

    private updateTimeElementWhenNotVisible(
        element: HTMLDivElement,
        containerClass: string): void
    {
        const container = element.getElementsByClassName(containerClass)[0] as HTMLDivElement;
        container.style.display = 'none';
    }
}

((doc: Document) => {
    return new Countdown(doc);
})(document);
