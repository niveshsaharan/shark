import Events from '../../resources/js/components/Events';

describe('Events', () => {
    it('queue is empty', function() {
        const $eventDispatcher = new Events();
        expect(Object.keys($eventDispatcher.queue)).to.be.length(0);
    });

    it('$on can register single and multiple listeners', function() {
        const $eventDispatcher = new Events();

        // Event 1
        const event1Listener = function(...args) {
            cy.log(args);
        };

        // Register listener
        $eventDispatcher.$on('event1', event1Listener);

        // Assertions
        expect(Object.keys($eventDispatcher.queue)).to.be.length(1);
        expect(Object.keys($eventDispatcher.queue.event1)).to.be.length(1);
        expect(Object.keys($eventDispatcher.queue)[0]).to.be.eq('event1');
        expect($eventDispatcher.queue.event1[0]).to.be.eq(event1Listener);

        // Event 2
        const event2Listener = function(...args) {
            cy.log(args);
        };

        // Register listener
        $eventDispatcher.$on('event2', event2Listener);

        // Assertions
        expect(Object.keys($eventDispatcher.queue)).to.be.length(2);
        expect(Object.keys($eventDispatcher.queue.event2)).to.be.length(1);
        expect(Object.keys($eventDispatcher.queue)[1]).to.be.eq('event2');
        expect($eventDispatcher.queue.event2[0]).to.be.eq(event2Listener);

        // Event 3
        const event3Listener = function(...args) {
            cy.log(args);
        };

        const event3Listener2 = function(...args) {
            cy.log(args);
        };

        // Register listeners for an event
        $eventDispatcher.$on('event3', event3Listener);
        $eventDispatcher.$on('event3', event3Listener2);

        // Assertions
        expect(Object.keys($eventDispatcher.queue)).to.be.length(3);
        expect(Object.keys($eventDispatcher.queue.event3)).to.be.length(2);
        expect(Object.keys($eventDispatcher.queue)[2]).to.be.eq('event3');
        expect($eventDispatcher.queue.event3[0]).to.be.eq(event3Listener);
        expect($eventDispatcher.queue.event3[1]).to.be.eq(event3Listener2);
    });

    it('$off can remove listeners', function() {
        const $eventDispatcher = new Events();

        const event1Listener = function(...args) {
            cy.log(args);
        };

        $eventDispatcher.$on('event1', event1Listener);

        // Assertions
        expect(Object.keys($eventDispatcher.queue.event1)).to.be.length(1);
        expect(Object.keys($eventDispatcher.queue)[0]).to.be.eq('event1');
        expect($eventDispatcher.queue.event1[0]).to.be.eq(event1Listener);

        $eventDispatcher.$off('event1', event1Listener);
        expect(Object.keys($eventDispatcher.queue.event1)).to.be.length(0);
    });

    it('$emit can call a listener', function() {
        const $eventDispatcher = new Events();

        const eventArgs = [
            'some-string-value',
            false,
            true,
            [1, 2],
            { key: 'value' },
        ];

        const event1Listener = function(...args) {
            args.forEach((arg, key) => {
                expect(arg).to.be.eq(eventArgs[key]);
            });
        };

        $eventDispatcher.$on('event1', event1Listener);
        $eventDispatcher.$emit('event1', ...eventArgs);
    });

    it('$emit can call all registered listeners', function() {
        const $eventDispatcher = new Events();

        const eventArgs = [
            'some-string-value',
            false,
            true,
            [1, 2],
            { key: 'value' },
        ];

        let called = 0;

        const event1Listener = function(...args) {
            called += 1;
            args.forEach((arg, key) => {
                expect(arg).to.be.eq(eventArgs[key]);
            });

            expect(called).to.be.eq(1);
        };

        const event1Listener2 = function(...args) {
            called += 1;
            args.forEach((arg, key) => {
                expect(arg).to.be.eq(eventArgs[key]);
            });
            expect(called).to.be.eq(2);
        };

        $eventDispatcher.$on('event1', event1Listener);
        $eventDispatcher.$on('event1', event1Listener2);
        $eventDispatcher.$emit('event1', ...eventArgs);
    });
});
