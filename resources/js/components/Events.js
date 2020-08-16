/**
 * Global Events handler
 */
export default class Events {
    /**
     * Constructor
     */
    constructor() {
        // Queue of event
        this.queue = {};
    }

    /**
     * Emit new event
     * @param {*} event
     * @param {*} data
     */
    $emit(event, ...data) {
        const queue = this.queue[event];

        if (typeof queue === 'undefined') {
            return false;
        }

        for (let i = 0; i < queue.length; i += 1) {
            queue[i](...data);
        }

        return true;
    }

    /**
     * Events listeners
     * @param {*} event
     * @param {*} callback
     */
    $on(event, callback) {
        if (typeof this.queue[event] === 'undefined') {
            this.queue[event] = [];
        }

        this.queue[event].push(callback);
    }

    /**
     * Un-Queue Events
     */
    $off(event, callback) {
        const {queue} = this;

        if (typeof queue[event] !== 'undefined') {
            if (typeof callback === 'undefined') {
                delete queue[event];
            } else {
                this.queue[event] = queue[event].filter(sub => sub !== callback);
            }
        }
    }
}
