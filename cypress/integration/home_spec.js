describe('home page', () => {
    beforeEach(() => {
        cy.refreshDatabase();
        cy.login({
            'shopify_domain': 'cypress.myshopify.com'
        });
    });

    it('shows correct information', () => {
        cy.visit('/')
            .wait(100)
            .get('#app')
            .as('page');


        cy.get('@page').contains('You\'re logged in as cypress.myshopify.com')
        cy.get('@page').contains('What a beautiful day!');
        cy.get('@page').get('.Polaris-ActionMenu').contains('Home').should('have.attr', 'disabled');

        cy.get('@page').get('.Polaris-ActionMenu').contains('Settings').as('settings_link').should('not.have.attr', 'disabled');
    });
});
