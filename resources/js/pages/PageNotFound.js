import React, { Component } from 'react';
import { EmptyState } from '@shopify/polaris';

class PageNotFound extends Component {
    constructor(props) {
        super(props);

        // State
        this.state = {
            timeout: 1000 * 6,
        };

        this.interval = null;
    }

    /**
     * Component mounted
     */
    componentDidMount() {
        this.interval = setInterval(() => this.tick(), 1000);
    }

    /**
     * Component will unmount
     */
    componentWillUnmount() {
        if (this.interval) {
            clearInterval(this.interval);
        }
    }

    /**
     * Tick every second
     */
    tick() {
        if (this.state.timeout > 1000) {
            this.setState(prevState => ({
                timeout: prevState.timeout - 1000,
            }));
        } else {
            clearInterval(this.interval);
            this.props.history.push('/');
        }
    }

    render() {
        return (
            <EmptyState
                heading="Page not found"
                action={{
                    content: 'Go to home',
                    onAction: () => this.props.history.push('/'),
                }}
                image="https://cdn.shopify.com/s/files/1/0757/9955/files/empty-state.svg"
            >
                <p>
                    The page you're trying to reach is not available. You'll be
                    redirected to home in {Math.ceil(this.state.timeout / 1000)}{' '}
                    {this.state.timeout / 1000 > 1 ? 'seconds' : 'second'}.
                </p>
            </EmptyState>
        );
    }
}

export default PageNotFound;
