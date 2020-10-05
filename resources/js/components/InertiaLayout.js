import { usePage } from '@niveshsaharan/inertia-react';
import React, { useEffect } from 'react';
import { Frame } from '@shopify/polaris';
import FlashListener from "./listeners/FlashListener";
import LoadingListener from "./listeners/LoadingListener";
import ConfirmListener from "./listeners/ConfirmListener";

export default function InertiaLayout({ title, children }) {
    const { flash } = usePage();

    useEffect(() => {
        document.title = title;
    }, [title]);

    useEffect(() => {
        if (flash.error || flash.success) {
            window.Events.$emit(
                'flash',
                flash.error || flash.success,
                !!flash.error
            );
        }
    }, [flash]);

    return <Frame>
        {children}
        <FlashListener />
        <LoadingListener />
        <ConfirmListener />
    </Frame>;
}
