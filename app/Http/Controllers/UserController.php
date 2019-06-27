<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\{StoreUserRequest, UpdateUserRequest};
use Auth, DB;
use App\{User, Phone, FavoriteBeer};


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('create', 'store');
    }

    public function create()
    {
        $data = [
            'user'   => '',
            'phones' => [new Phone],
            'url'    => 'user',
            'button' => 'Cadastrar'
        ];

        return view('auth.register', compact('data'));
    }

    public function store(StoreUserRequest $request)
    {

        DB::beginTransaction();
        try {
            $user = User::create([
                'name'      => $request['user']['name'],
                'email'     => $request['user']['email'],
                'password'  => Hash::make($request['user']['password'])
            ]);

            foreach($request->phones as $phone) {
                Phone::create([
                    'number'  => $phone['number'],
                    'user_id' => $user->id
                ]);
            }

            DB::commit();

            $credentials = [
                'email'    => $request['user']['email'],
                'password' => $request['user']['password']
            ];

            if (Auth::attempt($credentials)) {
                return redirect()->intended('/home')->with("success", "Cadastro realizado com sucesso!");
            }

        } catch(\Exception $e) {
            DB::rollback();
            return $e;
            return back()->with('error', 'Erro no servidor!');
        }

    }
    
    public function edit($id)
    {

        $user = User::findOrFail($id);

        $data = [
            'user'   => $user,
            'phones' => count($user->phones) ? $user->phones : [new Phone],
            'url'    => 'user/'.$user->id,
            'button' => 'Atualizar'
        ];

        if($data['user']->id !== Auth::user()->id) {
            return redirect('/')->with('warning', 'Você não tem permissão para acessar esse recurso!');
        }

        return view('auth.register', compact('data'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        if($user->id !== Auth::user()->id) {
            return redirect('/')->with('warning', 'Você não tem permissão para acessar esse recurso!');
        }

        DB::beginTransaction();
        try {

            $user->name = $request['user']['name'];
            $user->save();

            $phonesRequestIds = [];
            $phonesUserIds = [];

            //remoção de telefones
            foreach($request->input('phones') as $phone) {
                if(isset($phone['id'])) {
                    $phonesRequestIds[] = $phone['id'];
                }
            }
            foreach($user->phones as $phone) {
                $phonesUserIds[] = $phone->id;
            }

            $removedPhones = array_diff($phonesUserIds, $phonesRequestIds);

            if(count($removedPhones) > 0) {
                foreach($removedPhones as $phoneId) {
                    Phone::find($phoneId)->delete();
                }
            }
            //####################

            foreach($request->phones as $phone) {

                //Se o telefone já existir
                if(isset($phone['id'])) {
                    $phoneModel = Phone::find($phone['id']);
                    $phoneModel->update([ 'number' => $phone['number'] ]);
                } else {
                    Phone::create([
                        'number'  => $phone['number'],
                        'user_id' => $user->id
                    ]);
                }

            }

            DB::commit();
            return back()->with('success', 'Dados atualizados com sucesso!');

        } catch(\Exception $e) {

            DB::rollback();
            return $e;
            return back()->with('error', 'Erro no servidor!');

        }
    }

}
