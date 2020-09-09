describe('loading', () => {
    beforeEach(() => {
        cy.login();
    });

    it('can start loading', () => {
        cy.visit('/');

        cy.window().then(win => {
            win.Events.$emit('loading.start');
            cy.get('#AppFrameLoadingBar').should('have.length', 1);
        });
    });

    it('can stop loading', () => {
        cy.visit('/');

        cy.window().then(win => {
            win.Events.$emit('loading.start');
            win.Events.$emit('loading.stop');

            cy.get('#AppFrameLoadingBar').should('have.length', 0);
        });
    });
});

describe('flash', () => {
    beforeEach(() => {
        cy.login();
    });

    it('can show flash message', () => {
        cy.visit('/');

        cy.window().then(win => {
            win.Events.$emit('flash', 'This is a plain flash message');
            cy.get('.Polaris-Frame-Toast.Polaris-Frame-Toast').contains(
                'This is a plain flash message'
            );
        });

        cy.window().then(win => {
            win.Events.$emit('flash', 'This is a error flash message', true);
            cy.get('.Polaris-Frame-Toast.Polaris-Frame-Toast--error').contains(
                'This is a error flash message'
            );
        });
    });
});

describe('confirm', () => {
    beforeEach(() => {
        cy.login();
    });

    it('can show confirm dialog', () => {
        cy.visit('/');

        cy.window().then(win => {
            win.Events.$emit('confirm', {
                title: 'This is the title for confirm dialog, do you see it?',
                confirmButton: 'Yes, I do',
                destructive: false,
                message:
                    'This is the content being displayed inside the modal body area.',
            });

            cy.get(
                '.Polaris-Modal-Dialog__Container .Polaris-Modal-Header__Title'
            ).contains('This is the title for confirm dialog, do you see it?');

            cy.get(
                '.Polaris-Modal-Dialog__Container .Polaris-TextContainer'
            ).contains(
                'This is the content being displayed inside the modal body area.'
            );

            cy.get(
                '.Polaris-Modal-Dialog__Container .Polaris-ButtonGroup .Polaris-Button--primary'
            )
                .should('not.have.class', 'Polaris-Button--destructive')
                .contains('Yes, I do');

            cy.get(
                '.Polaris-Modal-Dialog__Container .Polaris-ButtonGroup'
            ).contains('Cancel');
        });
    });

    it('can show confirm dialog with destructive button', () => {
        cy.visit('/');

        cy.window().then(win => {
            win.Events.$emit('confirm', {
                title: 'This is the title for confirm dialog, do you see it?',
                confirmButton: 'Yes, I do',
                destructive: true,
                message:
                    'This is the content being displayed inside the modal body area.',
            });

            cy.get(
                '.Polaris-Modal-Dialog__Container .Polaris-Modal-Header__Title'
            ).contains('This is the title for confirm dialog, do you see it?');

            cy.get(
                '.Polaris-Modal-Dialog__Container .Polaris-TextContainer'
            ).contains(
                'This is the content being displayed inside the modal body area.'
            );

            cy.get(
                '.Polaris-Modal-Dialog__Container .Polaris-ButtonGroup .Polaris-Button--destructive'
            ).contains('Yes, I do');

            cy.get(
                '.Polaris-Modal-Dialog__Container .Polaris-ButtonGroup'
            ).contains('Cancel');
        });
    });

    it('can close the model when close button is pressed', () => {
        cy.visit('/');

        cy.window().then(win => {
            win.Events.$emit('confirm', {
                title: 'This is the title for confirm dialog, do you see it?',
                confirmButton: 'Yes, I do',
                destructive: true,
                message:
                    'This is the content being displayed inside the modal body area.',
            });

            cy.get('body').contains(
                'This is the title for confirm dialog, do you see it?'
            );

            cy.get(
                '.Polaris-Modal-Dialog__Container .Polaris-ButtonGroup .Polaris-Button--destructive'
            ).click();

            cy.get('body').should(
                'not.have.text',
                'This is the title for confirm dialog, do you see it?'
            );
        });
    });

    it('passes true when confirm button is pressed', () => {
        cy.visit('/');

        cy.window().then(win => {
            win.Events.$emit(
                'confirm',
                {
                    title:
                        'This is the title for confirm dialog, do you see it?',
                    confirmButton: 'Yes, I do',
                    destructive: true,
                    message:
                        'This is the content being displayed inside the modal body area.',
                },
                re => {
                    expect(re).to.be.true;
                }
            );

            cy.get(
                '.Polaris-Modal-Dialog__Container .Polaris-ButtonGroup .Polaris-Button--destructive'
            ).click();
        });
    });

    it('passes false when cancel button is pressed', () => {
        cy.visit('/');

        cy.window().then(win => {
            win.Events.$emit(
                'confirm',
                {
                    title:
                        'This is the title for confirm dialog, do you see it?',
                    confirmButton: 'Yes, I do',
                    closeButton: 'Model close button',
                    destructive: true,
                    message:
                        'This is the content being displayed inside the modal body area.',
                },
                re => {
                    expect(re).to.be.false;
                }
            );

            cy.get('.Polaris-Modal-Dialog__Container .Polaris-ButtonGroup')
                .contains('Model close button')
                .click();
        });
    });
});
