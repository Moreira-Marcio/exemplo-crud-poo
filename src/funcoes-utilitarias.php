<?php

function formatarPreco(float $preco): string {
    
        return  'R$ ' . number_format($preco, 2, ',', '.');
    }

    