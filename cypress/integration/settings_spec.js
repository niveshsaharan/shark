describe('settings page', () => {
    beforeEach(() => {
        cy.refreshDatabase();
        cy.login({
            'shopify_domain': 'cypress.myshopify.com'
        });
    });

    it('shows settings', () => {

        cy.visit('/settings')
            .wait(100)
            .get('#app')
            .as('page');

        cy.get('@page').contains('You\'re logged in as cypress.myshopify.com');

        cy.get('@page').contains('Desktop settings');
        cy.get('@page').contains('Mobile settings');
    });

    it('enables save button when setting is changed', () => {
        cy.visit('/settings')
            .wait(100)
            .get('#app')
            .as('page');

        cy.get('@page').get('.Polaris-ActionMenu').contains('Home').should('not.have.attr', 'disabled');

        cy.get('@page').get('.Polaris-ActionMenu').contains('Settings').as('settings_link').should('have.attr', 'disabled');

        cy.get('@page').contains('Save').should('have.attr', 'disabled')

        cy.get('@page').get('.Polaris-Layout__AnnotationWrapper:first').find('.Polaris-Button').click();

        cy.get('@page').contains('Save').should('not.have.attr', 'disabled')

        cy.get('@page').get('.Polaris-Layout__AnnotationWrapper:first').find('.Polaris-Button').click();

        cy.get('@page').contains('Save').should('have.attr', 'disabled')
    });
});
