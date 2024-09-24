import React from 'react';

export default function Home({ message }) {
    return (
        <div className="p-6 text-center">
            <h1 className="text-4xl font-bold">{message}</h1>
        </div>
    );
}
