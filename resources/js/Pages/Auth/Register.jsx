import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';
import InputMask from 'react-input-mask';
import { ToastContainer, toast } from 'react-toastify'; // Adicionar toastify
import 'react-toastify/dist/ReactToastify.css'; // Importar estilo

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        date_birth: '',
        phone: '',
        gender: '',
        password: '',
        password_confirmation: '',
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('register'), {
            onFinish: () => {
                reset('password', 'password_confirmation');
            },
            onError: () => {
                toast.error('Ocorreu um erro ao registrar o usuário.');
            }

        });
    };

    return (
        <GuestLayout>
            <Head title="Register"/>
            <ToastContainer />
            <form onSubmit={submit}>
                <div>
                    <InputLabel htmlFor="name" value="Name"/>

                    <TextInput
                        id="name"
                        name="name"
                        value={data.name}
                        className="mt-1 block w-full"
                        autoComplete="name"
                        isFocused={true}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                    />

                    <InputError message={errors.name} className="mt-2"/>
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="email" value="Email"/>

                    <TextInput
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full"
                        autoComplete="username"
                        onChange={(e) => setData('email', e.target.value)}
                        required
                    />

                    <InputError message={errors.email} className="mt-2"/>
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="date_birth" value="Date of Birth"/>

                    <TextInput
                        id="date_birth"
                        type="date"
                        name="date_birth"
                        value={data.date_birth}
                        className="mt-1 block w-full"
                        autoComplete="bday"
                        onChange={(e) => setData('date_birth', e.target.value)}
                        required
                    />

                    <InputError message={errors.date_birth} className="mt-2"/>
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="phone" value="Phone"/>

                    <InputMask
                        mask="(99) 99999-9999"
                        value={data.phone}
                        onChange={(e) => setData('phone', e.target.value)}
                    >
                        {(inputProps) => (
                            <TextInput
                                {...inputProps}
                                id="phone"
                                type="text"
                                name="phone"
                                className="mt-1 block w-full"
                                required
                            />
                        )}
                    </InputMask>

                    <InputError message={errors.phone} className="mt-2"/>
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="gender" value="Gender"/>

                    <select
                        id="gender"
                        name="gender"
                        value={data.gender}
                        className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        onChange={(e) => setData('gender', e.target.value)}
                        required
                    >
                        <option value="">Selecione Gênero</option>
                        <option value="male">Masculino</option>
                        <option value="female">Feminino</option>
                        <option value="other">Outro</option>
                    </select>

                    <InputError message={errors.gender} className="mt-2"/>
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Password"/>

                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) => setData('password', e.target.value)}
                        required
                    />

                    <InputError message={errors.password} className="mt-2"/>
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="password_confirmation" value="Confirm Password"/>

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        value={data.password_confirmation}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        required
                    />

                    <InputError message={errors.password_confirmation} className="mt-2"/>
                </div>

                <div className="flex items-center justify-end mt-4">
                    <Link
                        href={route('login')}
                        className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>

                    <PrimaryButton className="ms-4" disabled={processing}>
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
}
