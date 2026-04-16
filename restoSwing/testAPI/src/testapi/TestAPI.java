/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package testapi;
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
public class TestAPI {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
    /* String json1 = "[\"D'Artagnan\",\"Atos\",\"Portos\",\"Aramis\"]";
        // Collection recevant le JSON
        ArrayList<String> mousquetaires = new ArrayList<>();
        // Parse le tableau JSON
        try {
            JSONArray mousquetaires_json = new JSONArray(json1);
            
            // Parcoure le tableau JSON
            for (int i = 0; i < mousquetaires_json.length(); i++) {
                mousquetaires.add(mousquetaires_json.getString(i));
            } // for
            
            // Parcoure la collection
            System.out.println("-- Liste des mousquetaires --");
            for (int i = 0; i < mousquetaires.size(); i++) {
                System.out.println(i + " " + mousquetaires.get(i));
            } // for
            
        } catch (JSONException ex) {
            System.err.println("Erreur : " + ex.getMessage());
            //ex.printStackTrace();
        }
    */
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
