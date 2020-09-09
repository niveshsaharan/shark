import React, { Component } from 'react';
import { Frame as PolarisFrame, Loading } from '@shopify/polaris';

export default class LoadingListener extends Component {
    state = {
        loading: false,
    };

    /**
     * Component mounted
     */
    componentDidMount() {
        window.Events.$on('loading.start', this.startLoading);
        window.Events.$on('loading.stop', this.stopLoading);
    }

    /**
     * Component is unmounting
     */
    componentWillUnmount() {
        window.Events.$off('loading.start', this.startLoading);
        window.Events.$off('loading.stop', this.stopLoading);
    }

    /**
     * Start loading
     */
    startLoading = () => {
        this.setState({ loading: true });
    };

    /**
     * Stop loading
     */
    stopLoading = () => {
        this.setState({ loading: false });
    };

    /**
     * Render component
     */
    render() {
        const content = [];

        if (this.state.loading) {
            content.push(
                <PolarisFrame key="loading">
                    <Loading />
                </PolarisFrame>
            );
        }

        return content;
    }
}
