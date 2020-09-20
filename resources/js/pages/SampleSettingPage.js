import React from 'react';
import {
    Page,
    Layout,
    Banner,
    TextStyle,
    SettingToggle,
} from '@shopify/polaris';
import { Inertia } from '@niveshsaharan/inertia';

import { config, route } from '../functions';
import InertiaLayout from '../components/InertiaLayout';

export default class SampleSettingPage extends React.Component {
    state = {
        settings: this.props.settings,
    };

    save = () => {
        this.props.beforeSend().then(({ headers }) => {
            Inertia.put(route('setting.update'), this.state.settings, {
                replace: false,
                preserveState: false,
                preserveScroll: true,
                headers,
            });
        });
    };

    render() {
        return (
            <InertiaLayout title="Settings">
                <Page
                    title="Settings"
                    primaryAction={{
                        content: 'Save',
                        disabled:
                            JSON.stringify(this.props.settings) ===
                            JSON.stringify(this.state.settings),
                        onAction: this.save,
                    }}
                    secondaryActions={[
                        {
                            content: 'Home',
                            disabled: route().current('home'),
                            onAction: () =>
                                this.props.beforeSend().then(({ headers }) => {
                                    Inertia.visit(route('home'), {
                                        headers,
                                    });
                                }),
                        },
                        {
                            content: 'Settings',
                            disabled: route().current('setting.index'),
                            onAction: () =>
                                this.props.beforeSend().then(({ headers }) => {
                                    Inertia.visit(route('setting.index'), {
                                        headers,
                                    });
                                }),
                        },
                    ]}
                    actionGroups={[]}
                >
                    <Layout>
                        <Layout.Section>
                            <Banner
                                status="info"
                                title={`You're logged in as ${config(
                                    'shop.shopify_domain'
                                )}`}
                            />
                        </Layout.Section>

                        <Layout.AnnotatedSection
                            title="Desktop settings"
                            description="Enable or disable the app for desktop users"
                        >
                            <SettingToggle
                                action={{
                                    content: this.state.settings.desktop_status
                                        ? 'Disable'
                                        : 'Enable',
                                    onAction: () => {
                                        this.setState({
                                            settings: {
                                                ...this.state.settings,
                                                desktop_status: !this.state
                                                    .settings.desktop_status,
                                            },
                                        });
                                    },
                                }}
                                enabled={this.state.settings.desktop_status}
                            >
                                The app is{' '}
                                <TextStyle variation="strong">
                                    {this.state.settings.desktop_status
                                        ? 'enabled'
                                        : 'disabled'}
                                </TextStyle>{' '}
                                on desktop.
                            </SettingToggle>
                        </Layout.AnnotatedSection>

                        <Layout.AnnotatedSection
                            title="Mobile settings"
                            description="Enable or disable the app for mobile users"
                        >
                            <SettingToggle
                                action={{
                                    content: this.state.settings.mobile_status
                                        ? 'Disable'
                                        : 'Enable',
                                    onAction: () => {
                                        this.setState({
                                            settings: {
                                                ...this.state.settings,
                                                mobile_status: !this.state
                                                    .settings.mobile_status,
                                            },
                                        });
                                    },
                                }}
                                enabled={this.state.settings.mobile_status}
                            >
                                The app is{' '}
                                <TextStyle variation="strong">
                                    {this.state.settings.mobile_status
                                        ? 'enabled'
                                        : 'disabled'}
                                </TextStyle>{' '}
                                on mobile.
                            </SettingToggle>
                        </Layout.AnnotatedSection>
                    </Layout>
                </Page>
            </InertiaLayout>
        );
    }
}
