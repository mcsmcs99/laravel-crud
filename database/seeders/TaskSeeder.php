<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        $statuses = ['pending', 'in_progress', 'completed'];

        $titles = [
            'Revisar documentação do projeto',
            'Enviar relatório semanal',
            'Organizar reunião com o cliente',
            'Atualizar dependências do sistema',
            'Testar nova funcionalidade de login',
            'Criar mockups para novo layout',
            'Escrever testes automatizados',
            'Corrigir bug no formulário de cadastro',
            'Planejar sprint da próxima semana',
            'Fazer backup do banco de dados',
            'Analisar feedbacks de usuários',
            'Refatorar código do dashboard',
            'Integrar API externa de pagamentos',
            'Agendar deploy em produção',
            'Pesquisar novas ferramentas de produtividade'
        ];

        foreach (range(1, 20) as $i) {
            $title = $faker->randomElement($titles);
            $createdAt = $faker->dateTimeBetween('-1 year', 'now');
            $updatedAt = $faker->dateTimeBetween($createdAt, 'now');

            Task::create([
                'title' => $title,
                'description' => $faker->realText(100, 2), // Gera texto realista em português (~100 caracteres)
                'status' => $faker->randomElement($statuses),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }
}
