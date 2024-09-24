import React from 'react';

export default function Welcome({ canLogin, canRegister, laravelVersion, phpVersion }) {
    return (
        <div className="min-h-screen flex flex-col items-center justify-center bg-gray-100">
            <div className="bg-white shadow-md rounded-lg p-8">
                <h1 className="text-4xl font-bold text-gray-800 mb-6">Welcome to Inertia.js with React</h1>
                <p className="text-lg text-gray-600 mb-4">Laravel Version: <span className="text-gray-800 font-semibold">{laravelVersion}</span></p>
                <p className="text-lg text-gray-600 mb-8">PHP Version: <span className="text-gray-800 font-semibold">{phpVersion}</span></p>

                <div className="flex space-x-4">
                    {canLogin && (
                        <a href="/login" className="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Login
                        </a>
                    )}
                    {canRegister && (
                        <a href="/register" className="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                            Register
                        </a>
                    )}
                </div>
            </div>
        </div>
    );
}
