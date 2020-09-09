import React, { Component } from 'react';
import { Frame as PolarisFrame, Modal, TextContainer } from '@shopify/polaris';

export default class ConfirmListener extends Component {
    state = {
        show: false,
        data: {},
        callback: null,
    };

    componentDidMount() {
        window.Events.$on('confirm', this.open);
    }

    componentWillUnmount() {
        window.Events.$off('confirm', this.open);
    }

    open = (data, callback) => {
        this.setState({ show: true, data, callback });
    };

    close = (confirm = false) => {
        this.setState(
            {
                show: false,
            },
            typeof this.state.callback === 'function'
                ? this.state.callback(confirm === true)
                : null
        );
    };

    /**
     * Render component
     */
    render() {
        const content = [];

        if (this.state.show) {
            content.push(
                <PolarisFrame key="confirm">
                    <div style={{ height: this.state.data.height || '500px' }}>
                        <Modal
                            instant
                            open
                            onClose={this.close}
                            title={
                                this.state.data.title ||
                                'Are you sure you want to perform this action?'
                            }
                            primaryAction={{
                                content:
                                    this.state.data.confirmButton || 'Confirm',
                                destructive: !!this.state.data.destructive,
                                onAction: () => {
                                    this.close(true);
                                },
                            }}
                            secondaryActions={[
                                {
                                    content:
                                        this.state.data.closeButton || 'Cancel',
                                    onAction: this.close,
                                },
                            ]}
                        >
                            <Modal.Section>
                                <TextContainer>
                                    <div>{this.state.data.message}</div>
                                </TextContainer>
                            </Modal.Section>
                        </Modal>
                    </div>
                </PolarisFrame>
            );
        }

        return content;
    }
}
