import { usePage } from '@inertiajs/inertia-react'
import React, { useEffect } from 'react';

export default function InertiaLayout({ title, children }) {
    const { flash } = usePage()

    useEffect(() => {
        document.title = title;
    }, [title]);

    useEffect(() => {
        if(flash.error || flash.success)
        {
            window.Events.$emit('flash', flash.error || flash.success);
        }
    });

    return (
        <>
            {children}
        </>
    )
}
