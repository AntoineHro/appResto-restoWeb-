/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package restoswing;

/**
 *
 * @author antoine
 */
public class Ligne {
    private int idProduit;
    private String plat;
    private int quantite;
    
    public Ligne(int idProduit, String plat, int quantite){
        this.idProduit = idProduit;
        this.plat = plat;
        this.quantite = quantite;
    }
    
    public void setIdProduit(int idProduit) {
        this.idProduit = idProduit;
    }

    public void setPlat(String plat) {
        this.plat = plat;
    }

    public void setQuantite(int quantite) {
        this.quantite = quantite;
    }

    public int getIdProduit() {
        return idProduit;
    }

    public String getPlat() {
        return plat;
    }

    public int getQuantite() {
        return quantite;
    }
            
    public void afficher(){
        System.out.println("");
        System.out.println("ID-produit" + idProduit);
        System.out.println("Plat" + plat);
        System.out.println("Quantite" + quantite);
    }
}
