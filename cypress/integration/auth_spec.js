describe('Authentication', () => {

    beforeEach(() => {
        cy.refreshDatabase();
    })

    describe('guest', function () {

        it('redirects to auth page and has required input fields', () => {
            cy.visit('/')
                .assertRedirect('/auth')
                .get('form[action$="/auth"]')
                .as('form')
                .should('have.attr', 'method', 'POST')
                .should('have.attr', 'action', Cypress.config('baseUrl') + '/auth');

                cy.get('@form')
                .get('[name="shop"]')
                .as('input.shop');

                cy.get('@form')
                .get('[type="submit"]')
                .as('input.submit');
        });
    });

})
