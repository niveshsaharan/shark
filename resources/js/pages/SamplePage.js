import React from 'react';
import {
    Page,
    Layout,
    Banner,
    Card,
    DataTable,
} from '@shopify/polaris';

import {config} from '../functions';

export default class SamplePage extends React.Component{

    state = {
        settings: {}
    }

    componentDidMount() {
        axiosApiClient.get('/api/settings').then(({data}) => {
            this.setState({settings: data.settings});
        })
    }

    render() {
        return <Page
            title={this.props.title}
            secondaryActions={[]}
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
                    <Card>
                        <DataTable
                            columnContentTypes={[
                                'text',
                                'text',
                            ]}
                            headings={[
                                'Setting name',
                                'Value',
                            ]}
                            rows={Object.keys(this.state.settings).map(key => [key, JSON.stringify(this.state.settings[key] ? this.state.settings[key] : "-", null, 4)])}
                        />
                    </Card>
                </Layout.Section>
            </Layout>
        </Page>
    }
}
