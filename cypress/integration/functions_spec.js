import {object_get, config} from "../../resources/js/functions";


describe('functions', () => {
    context('object_get', () => {

        it('can return direct key value', () => {
            expect(object_get({
                name: 'tester',

            }, 'name')).to.eq('tester')
        })

        it('can return nested key value', () => {
            expect(object_get({
                name: 'tester',
                first: {
                    second: {
                        third: 'some-random-value'
                    }
                }

            }, 'first.second.third')).to.eq('some-random-value')
        });

        it('returns default value if the key does not have a value', () => {
            expect(object_get({
                name,
            }, 'name', 'default-value')).to.eq('default-value')
        });

        it('does not return default value if the key is found', () => {
            expect(object_get({
                name: 'tester',
            }, 'name', 'default-value')).to.eq('tester')
        })

        it('returns default value if the key is not found', () => {
            expect(object_get({
                name: 'tester',
            }, 'first.second.third', 'default-value')).to.eq('default-value')
        })

        it('returns undefined if the key is not found and default value is empty', () => {
            expect(object_get({
                name: 'tester',
            }, 'first.second.third', '')).to.be.undefined
        })
    });

    context('config', () => {
        it('returns value from object_get function', () => {
            const Env = {
                shop: {
                    shopify_domain: "some-value"
                }
            }

            const obj = {
                config (...args) {
                    return object_get(Env, ...args)
                }
            }

            const spy = cy.spy(obj, 'config').as('config')

            obj.config('shop.shopify_domain')
            expect(spy).to.have.returned('some-value')

            obj.config('shop.invalid-key')
            expect(spy).to.have.returned(undefined)

            obj.config('shop.invalid-key', 'default-value')
            expect(spy).to.have.returned('default-value')
        });
    });
});
