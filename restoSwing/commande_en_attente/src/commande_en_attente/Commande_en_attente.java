/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package commande_en_attente;
import java.util.ArrayList;
import org.json.*;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
/**
 *
 * @author antoine
 */
public class Commande_en_attente {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        String json = ""; // Le JSON brut
        String url = "http://localhost/projet/appRoseBlanche/api/commandes_en_attente.php";
        // Créer un HttpClient
        HttpClient client = HttpClient.newHttpClient();
        // Crée une requête HTTP GET
        try {
            // Construit l'URL de la requête
            HttpRequest request = HttpRequest.newBuilder()
                    .uri(new URI(url))
        .build();
            // Envoie la requête et attend la réponse
            HttpResponse<String> response = client.send(request,
        HttpResponse.BodyHandlers.ofString());
            // Vérifie que la réponse est normale
            if (response.statusCode() == 200) {
                json = response.body();
            } else {
                System.err.println("Erreur : Code statut " + response.statusCode());
            }
        } catch (Exception ex) {
            System.err.println("Erreur : " + ex.getMessage());
            //ex.printStackTrace();
        }
        System.out.println(json);
    }
    
}
