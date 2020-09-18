import React from 'react';
import {
    Page,
    Layout,
    Banner,
    Card,
    SkeletonBodyText,
    DisplayText,
} from '@shopify/polaris';
import { Inertia } from '@inertiajs/inertia';
import { config, route } from '../functions';
import InertiaLayout from '../components/InertiaLayout';

export default function(props) {
    return (
        <InertiaLayout title="Home">
            <Page
                title="Home"
                secondaryActions={[
                    {
                        content: 'Home',
                        disabled: route().current('home'),
                        onAction: () => Inertia.visit(route('home')),
                    },
                    {
                        content: 'Settings',
                        disabled: route().current('setting.index'),
                        onAction: () => Inertia.visit(route('setting.index')),
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
                    <Layout.Section>
                        <Card sectioned>
                            <DisplayText size="extraLarge">
                                What a beautiful day!
                            </DisplayText>
                        </Card>
                        <Card sectioned title="Section name">
                            <SkeletonBodyText />
                        </Card>
                        <Card sectioned title="Section name">
                            <SkeletonBodyText />
                        </Card>
                    </Layout.Section>
                    <Layout.Section secondary>
                        <Card title="Section name">
                            <Card.Section>
                                <SkeletonBodyText lines={2} />
                            </Card.Section>
                            <Card.Section>
                                <SkeletonBodyText lines={1} />
                            </Card.Section>
                        </Card>
                        <Card title="Section name" subdued>
                            <Card.Section>
                                <SkeletonBodyText lines={2} />
                            </Card.Section>
                            <Card.Section>
                                <SkeletonBodyText lines={2} />
                            </Card.Section>
                        </Card>
                    </Layout.Section>
                </Layout>
            </Page>
        </InertiaLayout>
    );
}
