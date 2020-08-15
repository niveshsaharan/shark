<x-layout.guest>
    <div class="Polaris-Page Polaris-Page--narrowWidth">
        <div class="Polaris-Page__Content">
            <div class="Polaris-Layout">
                <div class="Polaris-Layout__Section">
                    <div class="Polaris-Banner Polaris-Banner--statusInfo Polaris-Banner--withinPage" tabindex="0"
                         role="status" aria-live="polite" aria-labelledby="Banner1Heading"
                         aria-describedby="Banner1Content">
                        <div class="Polaris-Banner__Ribbon">
                            <span
                                class="Polaris-Icon Polaris-Icon--colorTealDark Polaris-Icon--isColored Polaris-Icon--hasBackdrop">
                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <circle cx="10" cy="10" r="9"
                                            fill="currentColor"></circle>
                                    <path
                                        d="M10 0C4.486 0 0 4.486 0 10s4.486 10 10 10 10-4.486 10-10S15.514 0 10 0m0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8m1-5v-3a1 1 0 0 0-1-1H9a1 1 0 1 0 0 2v3a1 1 0 0 0 1 1h1a1 1 0 1 0 0-2m-1-5.9a1.1 1.1 0 1 0 0-2.2 1.1 1.1 0 0 0 0 2.2"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="Polaris-Banner__ContentWrapper">
                            <div class="Polaris-Banner__Heading" id="Banner1Heading">
                                <p
                                    class="Polaris-Heading">{{ config('shopify-app.app_name') }} is only for Shopify stores
                                    only</p>
                            </div>
                            <div class="Polaris-Banner__Content" id="Banner1Content">
                                <p>Shopify is a commerce platform
                                    that allows anyone to easily sell online, at a retail location, and everywhere in
                                    between. </p>
                                <div class="Polaris-Banner__Actions">
                                    <div class="Polaris-ButtonGroup">
                                        <div class="Polaris-ButtonGroup__Item">
                                            <div class="Polaris-Banner__PrimaryAction">
                                                <a target="_blank"
                                                   class="Polaris-Button Polaris-Button--outline"
                                                   href="{{ config('shark.shopify_affiliate_url') }}"
                                                   rel="noopener noreferrer"
                                                   data-polaris-unstyled="true">
                                                    <span
                                                        class="Polaris-Button__Content">
                                                        <span
                                                            class="Polaris-Button__Text">Learn more about Shopify</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Polaris-Layout__Section">
                    <div class="Polaris-Card">
                        <div class="Polaris-Card__Header">
                            <h2 class="Polaris-Heading">Login or Install {{ config('shopify-app.app_name') }}</h2>
                        </div>
                        <div class="Polaris-Card__Section">
                            <form action="{{ route('authenticate') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="Polaris-FormLayout">
                                    <div class="Polaris-FormLayout__Item">
                                        <div class="">
                                            <div class="Polaris-Labelled__LabelWrapper">
                                                <div class="Polaris-Label">
                                                    <label id="PolarisTextField1Label"
                                                           for="PolarisTextField1"
                                                           class="Polaris-Label__Text">Enter your Shopify store's URL</label>
                                                </div>
                                            </div>
                                            <div class="Polaris-Connected">
                                                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                    <div class="Polaris-TextField">
                                                        <input name="shop"
                                                               id="PolarisTextField1"
                                                               placeholder="example.myshopify.com"
                                                               class="Polaris-TextField__Input"
                                                               aria-labelledby="PolarisTextField1Label"
                                                               aria-invalid="false"
                                                               aria-multiline="false"
                                                               required
                                                               value="">
                                                        <div class="Polaris-TextField__Backdrop">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Polaris-FormLayout__Item">
                                        <button type="submit" class="Polaris-Button Polaris-Button--primary">
                                            <span
                                                class="Polaris-Button__Content">
                                                <span class="Polaris-Button__Text">Submit</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="Polaris-Card">
                        <div class="Polaris-Card__Header">
                            <h2 class="Polaris-Heading">What
                                is {{ config('shopify-app.app_name') }}?</h2>
                        </div>
                        <div class="Polaris-Card__Section">
                            <div class="Polaris-Stack Polaris-Stack--vertical Polaris-Stack--spacingLoose">
                                @if(config('shark.app_description'))
                                    <div class="Polaris-Stack__Item">
                                        <p>{{ config('shark.app_description') }}</p>
                                    </div>
                                @endif
                                <div class="Polaris-Stack__Item">
                                    <div class="Polaris-Stack Polaris-Stack--distributionTrailing">
                                        <div class="Polaris-Stack__Item">
                                            <div class="Polaris-ButtonGroup">
                                                @if(config('shark.demo_url'))
                                                <div class="Polaris-ButtonGroup__Item">
                                                    <a target="_blank"
                                                       class="Polaris-Button Polaris-Button--primary"
                                                       href="{{ config('shark.demo_url') }}"
                                                       rel="noopener noreferrer"
                                                       data-polaris-unstyled="true">
                                                        <span
                                                            class="Polaris-Button__Content">
                                                            <span
                                                                class="Polaris-Button__Text">View demo</span>
                                                        </span>
                                                    </a>
                                                </div>
                                                @endif

                                                @if(config('shark.app_slug'))
                                                <div class="Polaris-ButtonGroup__Item Polaris-ButtonGroup__Item--plain">
                                                    <a target="_blank" class="Polaris-Button Polaris-Button--plain"
                                                       href="https://apps.shopify.com/{{ config('shark.app_slug') }}"
                                                       rel="noopener noreferrer" data-polaris-unstyled="true">
                                                        <span
                                                            class="Polaris-Button__Content">
                                                            <span
                                                                class="Polaris-Button__Text">View on Shopify App store</span>
                                                        </span>
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.guest>
