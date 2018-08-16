declare module 'odometer' {
    interface OdometerOptions {
        format?: string;
        duration?: number;
        el?: HTMLElement;
        value?: string;
        theme?: string;
    }
    
    class Odometer {
        constructor(options?: OdometerOptions);
        render(): void;
    }
}

declare interface OdometerGlobalOptions {
    auto: boolean;
}

declare interface Window {
    odometerOptions: OdometerGlobalOptions;
}
