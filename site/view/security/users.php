<?php $users = $result["data"]["users"]; ?>

<h1 class="text-2xl font-bold text-center my-6 text-gray-800">Liste des utilisateurs</h1>

<div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full text-left">
        <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
            <tr>
                <th class="px-6 py-3">Pseudo</th>
                <th class="px-6 py-3">Rôle</th>
                <th class="px-6 py-3">Inscription</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-gray-800">

            <?php /* var_dump($users); die(); */ foreach ($users as $user): /* var_dump($user); die(); */ ?>
                <tr>
                    <td class="px-6 py-4 font-medium"><?= $user->getNickName() ?></td>
                    <td class="px-6 py-4"><?= $user->getRole() ?></td>
                    <td class="px-6 py-4">
                    <?php
                    $date = $user->getRegistrationDate();
                    echo is_string($date) ? (new DateTime($date))->format('d/m/Y H:i') 
                        : ($date instanceof DateTime ? $date->format('d/m/Y H:i') : "?");
                    ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
