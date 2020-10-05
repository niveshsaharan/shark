import React, { Component } from 'react';
import { Toast } from '@shopify/polaris';

export default class FlashListener extends Component {
    state = {
        show: false,
        content: null,
        error: false,
        duration: 5000,
    };

    componentDidMount() {
        window.Events.$on('flash', this.onFlash);
    }

    componentWillUnmount() {
        window.Events.$off('flash', this.onFlash);
    }

    onFlash = (content, error = false) => {
        this.setState({
            ...this.state,
            show: true,
            error: error === true,
            content,
        });
    };

    /**
     * Render component
     */
    render() {
        const content = [];

        if (this.state.show) {
            content.push(
                <Toast
                    key="flash"
                    {...this.state}
                    onDismiss={() => this.setState({ show: false })}
                />
            );
        }

        return content;
    }
}
